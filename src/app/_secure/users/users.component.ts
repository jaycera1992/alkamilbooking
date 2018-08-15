import { Component, OnInit, EventEmitter, Output, Input } from '@angular/core';
import { Router } from '@angular/router';

import { UsersService } from './../../_service/users.service';

@Component({
  moduleId: module.id,
  selector: 'app-users',
  templateUrl: './users.component.html',
  styleUrls: ['./users.component.css']
})
export class UsersComponent implements OnInit {

  crudTransaction: number;

  p = 1;

  total = 0;
  totalUsers = 0;
  totalDeletedUsers = 0;
  totalActiveUsers = 0;
  totalStaff = 0;

  selectedIndex: number;
  selectedItem: any;

  userArr = [];

  hideHttpServerError = false;

  constructor(
    private _router: Router,
    private _usersService: UsersService,
  ) { }

  ngOnInit() {
    this.crudTransaction = 1;
    this.getUsers(this.p);
  }

  getUsers(page) {
    this._usersService.getUsers(page).subscribe(
      response => {

        if (response.success === true) {
          this.userArr = response.data;
          this.getTotal();
          this.getDeletedTotal();
          this.getActiveTotal();
          // this.getTotalStaff();
        } else {
        
        }
      },
      error => {
        if (error.status == 401) {
          this._router.navigate(['/login']);
        } else {
          this.hideHttpServerError = true;
          setTimeout(() => {
            this.hideHttpServerError = false;
          }, 10000);
        }  
      }
    );
  }

  getTotal() {
    this._usersService.getTotal().subscribe(
      response => {
        if (response.success === true) {
          this.totalUsers = response.data.total;
        }
      },
      error => {
        if (error.status == 401) {
          this._router.navigate(['/login']);
        } else {
          this.hideHttpServerError = true;
          setTimeout(() => {
            this.hideHttpServerError = false;
          }, 10000);
        }
      }
    );
  }

  getDeletedTotal() {
    this._usersService.getDeletedTotal().subscribe(
      response => {
        if (response.success === true) {
          this.totalDeletedUsers = response.data.total;
        }
      },
      error => {
        if (error.status == 401) {
          this._router.navigate(['/login']);
        } else {
          this.hideHttpServerError = true;
          setTimeout(() => {
            this.hideHttpServerError = false;
          }, 10000);
        }
      }
    );
  }

  getActiveTotal() {
    this._usersService.getActiveTotal().subscribe(
      response => {
        if (response.success === true) {
          this.totalActiveUsers = response.data.total;
        }
      },
      error => {
        if (error.status == 401) {
          this._router.navigate(['/login']);
        } else {
          this.hideHttpServerError = true;
          setTimeout(() => {
            this.hideHttpServerError = false;
          }, 10000);
        }
      }
    );
  }

  // getTotalStaff() {
  //   this._usersService.getTotalStaff().subscribe(
  //     response => {
  //       if (response.success === true) {
  //         this.totalStaff = response.data.total;
  //       }
  //     },
  //     error => {
  //       if (error.status == 401) {
  //         this._router.navigate(['/login']);
  //       } else {
  //         this.hideHttpServerError = true;
  //         setTimeout(() => {
  //           this.hideHttpServerError = false;
  //         }, 10000);
  //       }
  //     }
  //   );
  // }

  fromEmit(event: any) {
    let trigger: number;
    trigger = event.trigger;

    if (trigger == 1) {
      this.crudTransaction = 1;
    } else if (trigger == 2) {
      this.crudTransaction = 2;
    } else if (trigger == 3) {
      this.crudTransaction = 3;

      this.selectedIndex = event.selectedIndex;
      this.selectedItem = event.selectedItem;
      
    } else if (trigger == 4) {
      this.crudTransaction = 1;
      this.p = 1;
      this.total = 0;
      this.getUsers(this.p);
    }
  }

  pageChanged(page: any) {
    this.getUsers(page);
    this.p = page;
  }

}
