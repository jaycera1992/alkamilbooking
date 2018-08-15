import { NgModule } from '@angular/core';
import { HttpModule, Http } from '@angular/http';
import { CommonModule } from '@angular/common';
import { HttpClientModule, HttpClient } from '@angular/common/http';
import { FormsModule } from '@angular/forms';
import { Router, RouterModule } from '@angular/router';

import { MaterialModule } from './../../_module/material/material.module';
import { HttpErrorComponent } from './../../_public/http-error/http-error.component';
import { NgxPaginationModule } from 'ngx-pagination';
import { InputSwitchModule } from 'primeng/inputswitch';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    CommonModule,
    HttpClientModule,
    RouterModule,
    NgxPaginationModule,
    InputSwitchModule,
    MaterialModule
  ],
  declarations: [
    HttpErrorComponent
  ],
  exports: [
    HttpErrorComponent,
    NgxPaginationModule,
    MaterialModule
  ]
})
export class SharedComponentModule { }
