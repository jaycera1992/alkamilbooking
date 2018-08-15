import { Component, OnInit, EventEmitter, Output, Input } from '@angular/core';
import { Router } from '@angular/router';

import { GroceryService } from './../../../_service/grocery.service';

@Component({
  selector: 'app-supplier-list',
  templateUrl: './supplier-list.component.html',
  styleUrls: ['./supplier-list.component.css']
})
export class SupplierListComponent implements OnInit {

  @Output() showEditForm = new EventEmitter<any>();

  @Input() categoryList = [];
  @Input() p: number;
  @Input() total: number;
  @Input() totalCategory: number;

  hideHttpServerError = false;

  totalCount : any;

  constructor(
    private _router: Router,
    private _groceryService: GroceryService
  ) { }

  ngOnInit() {
  }

  callCountData(categoryId) {
    this._groceryService.getCategoryTotalById(categoryId).subscribe(
      response => {
        if (response.success === true) {
          this.totalCount = response.data.total;
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

}
