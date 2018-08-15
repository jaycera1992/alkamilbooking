import { Component, OnInit, EventEmitter, Output, Input } from '@angular/core';
import { Router } from '@angular/router';

import { AppSettings } from './../../app.settings';

@Component({
  moduleId: module.id,
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.css']
})
export class DashboardComponent implements OnInit {

  loadingEvent = true;
  userDetails : any;

  usersNav = false;
  groceryNav = false;
  supplierNav = false;

  titleHeader: any;

  urlLink = AppSettings.URL_WEBSITE;

  constructor(
    private _router: Router
  ) { }

  ngOnInit() {
    setTimeout(() => {
      this.loadingEvent = false;
    }, 3000);
    const urlLink = window.location.href.split( '/' );

    if (urlLink[5] == 'users') {
      this.titleHeader = 'User Management';
      this.usersNav = true;
    } else if (urlLink[5] == 'grocery') {
      this.titleHeader = 'Grocery Management';
      this.groceryNav = true;
    } else if (urlLink[5] == 'supplier') {
      this.titleHeader = 'Supplier Management';
      this.supplierNav = true;
    }

    this.userDetails = JSON.parse(localStorage.getItem('user_details'));
  }

  logout(event: any) {

    localStorage.removeItem('user_details');
    localStorage.removeItem('user_id');
    localStorage.removeItem('total-marketdata');
    localStorage.removeItem('token');

    this._router.navigate(['/login']);
  }

  changeNav(nav: any) {
    if (nav == 'users') {
      this.usersNav = true;
      this.groceryNav = false;
      this.supplierNav = false;
      this.titleHeader = 'User Management';
    } else if (nav == 'grocery') {
      this.usersNav = false;
      this.groceryNav = true;
      this.supplierNav = false;
      this.titleHeader = 'Grocery Management';
    } else if (nav == 'supplier') {
      this.usersNav = false;
      this.groceryNav = false;
      this.supplierNav = true;
      this.titleHeader = 'Supplier Management';
    }
  }
}
