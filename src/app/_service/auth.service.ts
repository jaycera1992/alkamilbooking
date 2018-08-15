import { Injectable } from '@angular/core';
import { Http, Response, Headers, URLSearchParams } from '@angular/http';
import 'rxjs/add/operator/map';

import { AppSettings } from '../app.settings';

@Injectable()
export class AuthService {

  private _url: string = AppSettings.API_ENDPOINT + 'open/authenticate';

  constructor(private _http: Http) { }

  authenticate(data: any) {
    let params = 'data=' + JSON.stringify(data);
    let headers = new Headers();
    headers.append('Content-Type', 'application/x-www-form-urlencoded');

    return this._http.post(this._url, params, { headers: headers })
      .map((response: Response) => response.json());
  }
  
}
