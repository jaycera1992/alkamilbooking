import { Component, OnInit, EventEmitter, Output, Input } from '@angular/core';
import { Router } from '@angular/router';

import { GroceryService } from './../../_service/grocery.service';

@Component({
  selector: 'app-grocery',
  templateUrl: './grocery.component.html',
  styleUrls: ['./grocery.component.css']
})
export class GroceryComponent implements OnInit {

  crudTransaction: number;

  p = 1;

  total = 0;
  totalGrocery = 0;

  selectedIndex: number;
  selectedItem: any;

  groceryArr = [];

  hideHttpServerError = false;

  constructor(
    private _router: Router,
    private _groceryService: GroceryService,
  ) { }

  ngOnInit() {
    this.crudTransaction = 1  ;
    this.getCategory(this.p);
  }
  
  getCategory(page) {
    this._groceryService.getCategory(page).subscribe(
      response => {

        if (response.success === true) {
          this.groceryArr = response.data;
          this.getTotal();
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
    this._groceryService.getCategoryTotal().subscribe(
      response => {
        if (response.success === true) {
          localStorage.setItem('total-marketdata', response.data.total);
          this.totalGrocery = response.data.total;
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
      this.getCategory(this.p);
    }
  }

  pageChanged(page: any) {
    this.getCategory(page);
    this.p = page;
  }
  

}
