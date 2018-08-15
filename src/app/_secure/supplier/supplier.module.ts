import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { Routes, RouterModule } from '@angular/router';

import { SharedComponentModule } from './../../_module/shared-component/shared-component.module';

import { SupplierComponent } from './supplier.component';

import { GroceryService } from './../../_service/grocery.service';
import { SupplierListComponent } from './supplier-list/supplier-list.component';

const routes: Routes = [
  { path: '', component: SupplierComponent }
];


@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    RouterModule.forChild(routes),

    SharedComponentModule
  ],
  declarations: [
    SupplierComponent,
    SupplierListComponent
  ],
  exports: [
    SupplierComponent
  ],
  providers: [
    GroceryService
  ]
})
export class SupplierModule { }
