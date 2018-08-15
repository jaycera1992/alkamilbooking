import { Component, OnInit, EventEmitter, Output, Input } from '@angular/core';
import { Router } from '@angular/router';

import { GroceryService } from './../../_service/grocery.service';

@Component({
  selector: 'app-supplier',
  templateUrl: './supplier.component.html',
  styleUrls: ['./supplier.component.css']
})
export class SupplierComponent implements OnInit {

  crudTransaction: number;

  p = 1;

  total = 0;
  totalCategory = 0;

  hideHttpServerError = false;

  categoryList = [];

  constructor(
    private _router: Router,
    private _groceryService: GroceryService,
  ) { }

  ngOnInit() {
    this.crudTransaction = 1; 
    this.getCategoryReference();
  }

  getCategoryReference() {
    this._groceryService.getCategoryReference().subscribe(
      response => {
        if (response.success === true) {
          this.categoryList = response.data;
          this.totalCategory = response.data.length;
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

  pageChanged(page: any) {
    this.p = page;
  }
}
