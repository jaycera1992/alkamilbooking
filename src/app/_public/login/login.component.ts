import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

import { Auth } from './../../_class/auth';
import { AuthService } from './../../_service/auth.service';
import { AppSettings } from './../../app.settings';

@Component({
  moduleId: module.id,
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

  public auth: Auth;

  loadingLogin = false;
  userNotExist = false;
  hideHttpServerError = false;

  constructor(
    private _router: Router,
    private _authService: AuthService
  ) { }

  ngOnInit() {
    this.auth = {
      email: '',
      password: ''
    };
  }

  login(formData: Auth) {
    this.loadingLogin = true;

    this._authService.authenticate(formData).subscribe(
      response => {
        if (response.success === true) {
          localStorage.setItem('user_details', JSON.stringify(response.data));
          localStorage.setItem('user_id', response.user_id);
          localStorage.setItem('token', response.token);
          if(response.data.role == 1) {
            this._router.navigate(['/dashboard/users']);
          } else {
            this._router.navigate(['/dashboard/supplier']);
          }
        } else {
          this.loadingLogin = false;
          this.userNotExist = true;
          setTimeout(() => {
            this.userNotExist = false;
          }, 4000);
        }
      },
      error => {
        this.loadingLogin = false;

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
