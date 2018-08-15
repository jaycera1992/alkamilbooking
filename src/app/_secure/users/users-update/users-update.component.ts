import { Component, OnInit, EventEmitter, Output, Input } from '@angular/core';
import { Router } from '@angular/router';
import { SelectItem } from 'primeng/api';

import { User } from './../../../_class/user';
import { UsersService } from './../../../_service/users.service';

@Component({
  selector: 'app-users-update',
  templateUrl: './users-update.component.html',
  styleUrls: ['./users-update.component.css']
})
export class UsersUpdateComponent implements OnInit {

  adminRoles: SelectItem[];

  @Output() showEditForm = new EventEmitter<any>();

  @Input() selectedItem : any;
  @Input() selectedIndex: number;
  @Input() userArr = [];
  @Input() p: number;
  @Input() switchCase: number;
  @Input() total: number;
  @Input() totalUsers: number;

  public user: User;

  hideHttpServerError = false;
  loadingSave = false;
  successMessage = false;
  isActive: any;
  checked: any;

  constructor(
    private _router: Router,
    private _usersService: UsersService,
  ) { }

  ngOnInit() {

    this.adminRoles = [
      { value: '1', label: 'Administrator' },
      { value: '2', label: 'Supplier'}
    ];

    if (this.selectedItem.is_deleted == 0) {
      this.isActive = 'Active';
      this.checked = true;
    } else {
      this.isActive = 'Inactive';
      this.checked = false;
    }
    const contactNumber = this.selectedItem.contact_number.replace('+971', '');

    this.user = {
      firstName: this.selectedItem.first_name,
      lastName: this.selectedItem.last_name,
      email: this.selectedItem.email_address,
      password: '',
      adminRole: this.selectedItem.role_id,
      mobileNumber: contactNumber,
      designation: this.selectedItem.designation,
      isActive: this.selectedItem.is_deleted
    };
  }

  cancelAddStaff() {
    this.showEditForm.emit({ 'trigger': 1 });
  }

  submitStaff(formData: User) {
    this.loadingSave = true;
    if (this.checked) {
      formData.isActive = 0;
    } else {
      formData.isActive = 1;
    }
  
    this._usersService.updateUser(formData, this.selectedItem.user_id).subscribe(
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

  changeStatus() {
    if (this.checked) {
      this.isActive = 'Inactive';
      this.user.isActive = 1;
    } else {
      this.isActive = 'Active';
      this.user.isActive = 0;
    }

  }

}
