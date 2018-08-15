import { Component, OnInit, EventEmitter, Output, Input } from '@angular/core';
import { Router } from '@angular/router';

import { UsersService } from './../../../_service/users.service';

@Component({
  moduleId: module.id,
  selector: 'app-users-list',
  templateUrl: './users-list.component.html',
  styleUrls: ['./users-list.component.css']
})
export class UsersListComponent implements OnInit {

  @Output() showEditForm = new EventEmitter<any>();

  @Input() userArr = [];
  @Input() p: number;
  @Input() switchCase: number;
  @Input() total: number;
  @Input() totalUsers: number;

  userToBeDeletedId : any;
  loadingDelete = false;
  hideHttpServerError = false;
  successMessage = false;

  constructor(
    private _router: Router,
    private _usersService: UsersService,
  ) { }

  ngOnInit() {}

  addUser() {
    this.showEditForm.emit({ 'trigger': 2 });
  }

  setDeleteStaff(userId) {
    this.userToBeDeletedId = userId;
  }

  deleteStaff() {
    this.loadingDelete = true;
    
    this._usersService.deleteUser(this.userToBeDeletedId).subscribe(
      response => {
        if (response.success === true) {
          this.loadingDelete = false;
          this.successMessage = true;
        } else {
          this.loadingDelete = false;
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
          this.loadingDelete = false;
          this.hideHttpServerError = true;
          setTimeout(() => {
            this.hideHttpServerError = false;
          }, 10000);
        }
      }
    );
  }

  callEvent() {
    this.showEditForm.emit({ 'trigger': 4 });
    setTimeout(() => {
      this.successMessage = false;
      this.loadingDelete = false;
    }, 3000);
  }

  editUser(data: any, index: any) {
    this.showEditForm.emit({ 'trigger': 3, 'selectedItem': data, 'selectedIndex': index});
  }
}
