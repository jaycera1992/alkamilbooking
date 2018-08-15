import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { Routes, RouterModule } from '@angular/router';

import { SharedComponentModule } from './../../../_module/shared-component/shared-component.module';

import { LoginComponent } from './../login.component';

const routes: Routes = [
  { path: '', component: LoginComponent }
];

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    RouterModule.forChild(routes),

    SharedComponentModule
  ],
  declarations: [
    LoginComponent
  ]
})
export class LoginModule { }
