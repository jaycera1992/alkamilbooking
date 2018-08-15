import { Injectable } from '@angular/core';
import { CanActivate, ActivatedRouteSnapshot, RouterStateSnapshot } from '@angular/router';
import { Observable } from 'rxjs/Observable';
import { Router } from '@angular/router';

import { AuthService } from './../_service/auth.service';

@Injectable()
export class AuthGuard implements CanActivate {

  constructor(
    private _router: Router,
  ) {
  }

  canActivate(
    next: ActivatedRouteSnapshot,
    state: RouterStateSnapshot): Observable<boolean> | Promise<boolean> | boolean {

    const userId = localStorage.getItem('user_id');

    if (userId) {
      return true;
    } else {
      // this._router.navigate(['/register']);
      return false;
    }

  }
}
