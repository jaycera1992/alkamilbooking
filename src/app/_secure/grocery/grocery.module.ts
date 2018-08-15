import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { Routes, RouterModule } from '@angular/router';

import { SharedComponentModule } from './../../_module/shared-component/shared-component.module';

import { GroceryComponent } from './grocery.component';
import { GroceryAddComponent } from './grocery-add/grocery-add.component';

import { GroceryService } from './../../_service/grocery.service';
import { GroceryListComponent } from './grocery-list/grocery-list.component';

const routes: Routes = [
  { path: '', component: GroceryComponent }
];

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    RouterModule.forChild(routes),

    SharedComponentModule
  ],
  declarations: [
    GroceryComponent,
    GroceryAddComponent,
    GroceryListComponent
  ],
  exports: [
    GroceryComponent
  ],
  providers: [
    GroceryService
  ]
})
export class GroceryModule { }

