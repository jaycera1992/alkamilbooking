import { Component, OnInit, EventEmitter, Output, Input } from '@angular/core';
import { Router } from '@angular/router';
import { SelectItem } from 'primeng/api';

import { User } from './../../../_class/user';
import { UsersService } from './../../../_service/users.service';

@Component({
  moduleId: module.id,
  selector: 'app-users-add',
  templateUrl: './users-add.component.html',
  styleUrls: ['./users-add.component.css']
})
export class UsersAddComponent implements OnInit {

  adminRoles: SelectItem[];

  @Output() showEditForm = new EventEmitter<any>();

  @Input() userArr = [];
  @Input() p: number;
  @Input() switchCase: number;
  @Input() total: number;
  @Input() totalUsers: number;

  public user: User;

  hideHttpServerError = false;
  loadingSave = false;
  successMessage = false;

  constructor(
    private _router: Router,
    private _usersService: UsersService,
  ) { }

  ngOnInit() {
    this.adminRoles = [
      { value: '1', label: 'Administrator' },
      { value: '2', label: 'Supplier' }
    ];

    this.user = {
      firstName: '',
      lastName: '',
      email: '',
      password: '',
      adminRole: '',
      mobileNumber: '',
      designation: '',
      isActive: ''
    };
  }

  cancelAddStaff() {
    this.showEditForm.emit({ 'trigger': 1 });
  }

  submitStaff(formData: User) {
    this.loadingSave = true;
    this._usersService.addUsers(formData).subscribe(
      response => {
        if (response.success === true) {
          this.successMessage = true;
          setTimeout(() => {
             this.showEditForm.emit({ 'trigger': 4 });
          }, 3000);
        } else {
          this.loadingSave = false;
          this.hideHttpServerError = true;
          setTimeout(() => {
            this.hideHttpServerError = false;
          }, 10000);
        }
      },
      error => {
        if (error.status == 401) {
          this._router.navigate(['/login']);
        } else {
          this.loadingSave = false;
          this.hideHttpServerError = true;
          setTimeout(() => {
            this.hideHttpServerError = false;
          }, 10000);
        }
      }
    );
  }

}
