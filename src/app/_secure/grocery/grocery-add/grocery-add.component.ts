import { Component, OnInit, EventEmitter, Output, Input } from '@angular/core';
import { Router } from '@angular/router';
import { SelectItem } from 'primeng/api';

import { Grocery } from './../grocery';
import { Category } from './../grocery';

import { GroceryService } from './../../../_service/grocery.service';

@Component({
  moduleId: module.id,
  selector: 'app-grocery-add',
  templateUrl: './grocery-add.component.html',
  styleUrls: ['./grocery-add.component.css']
})
export class GroceryAddComponent implements OnInit {

  categoryReference: SelectItem[];

  @Output() showEditForm = new EventEmitter<any>();

  @Input() switchCase: number;
  @Input() groceryArr = [];
  @Input() p: number;
  @Input() total: number;
  @Input() totalGrocery: number;

  public grocery: Grocery;
  public category: Category;

  hideHttpServerError = false;
  loadingSave = false;
  successMessage = false;
  successMessageData = false;

  constructor(
    private _router: Router,
    private _groceryService: GroceryService,
  ) { }

  ngOnInit() {
    this.categoryReference = [];
    this.getCategoryReference();

    this.grocery = {
      category: ''
    };

    this.category = {
      categoryRef: ''
    };
  }

  cancelAddCategory() {
    this.showEditForm.emit({ 'trigger': 1 });
  }

  submitCategory(formData: Grocery) {
    this.loadingSave = true;
    this._groceryService.addCategory(formData).subscribe(
      response => {
        if (response.success === true) {
          this.successMessage = true;
          this.categoryReference.push({ value: this.categoryReference.length + 1, label: formData.category });
          formData.category = '';
          this.loadingSave = false;
          setTimeout(() => {
            this.successMessage = false;
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

  submitCategoryData(formData: Category) {  
    this.loadingSave = true;
    this._groceryService.addCategoryData(formData).subscribe(
      response => {
        if (response.success === true) {
          this.successMessageData = true;
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

  getCategoryReference() {
    this._groceryService.getCategoryReference().subscribe(
      response => {
        if (response.success === true) {
          for(let x = 0; x < response.data.length; x++) {
              const element = response.data[x];
              this.categoryReference.push({ value: element.id, label: element.text });
          }
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
