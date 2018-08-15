import { Component, OnInit, EventEmitter, Output, Input } from '@angular/core';
import { Router } from '@angular/router';

import { GroceryService } from './../../../_service/grocery.service';

@Component({
  selector: 'app-grocery-list',
  templateUrl: './grocery-list.component.html',
  styleUrls: ['./grocery-list.component.css']
})
export class GroceryListComponent implements OnInit {

  @Output() showEditForm = new EventEmitter<any>();

  @Input() groceryArr = [];
  @Input() p: number;
  @Input() switchCase: number;
  @Input() total: number;
  @Input() totalGrocery: number;

  hideHttpServerError = false;

  constructor(
    private _router: Router,
    private _groceryService: GroceryService,
  ) { }

  ngOnInit() {
  }

  
  addCategory() {
    this.showEditForm.emit({ 'trigger': 2 });
  }

}
