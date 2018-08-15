/* import { BrowserModule } from '@angular/platform-browser'; */
import { NgModule, CUSTOM_ELEMENTS_SCHEMA } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { HttpModule, Http } from '@angular/http';
import { HttpClientModule, HttpClient } from '@angular/common/http';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { AppRoutingModule } from './app-routing.module';

import { AppSettings } from './app.settings';
import { AuthGuard } from './_common/auth.guard';
import { AppComponent } from './app.component';
import { AuthService } from './_service/auth.service';

@NgModule({
  declarations: [AppComponent],
  imports: [
    /* BrowserModule, */
    FormsModule,
    HttpModule,
    HttpClientModule,
    BrowserAnimationsModule,
    AppRoutingModule,
  ],
  exports: [],
  providers: [
    AuthService,
  ],
  bootstrap: [AppComponent],
  schemas: [CUSTOM_ELEMENTS_SCHEMA]
})
export class AppModule {}
