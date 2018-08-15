import { Injectable } from '@angular/core';
import { Http, Response, Headers, URLSearchParams } from '@angular/http';
import 'rxjs/add/operator/map';

import { AppSettings } from '../app.settings';

@Injectable()
export class UsersService {

  private _url: string = AppSettings.API_ENDPOINT + 'secure';

  constructor(private _http: Http) { }

  getUsers(offset) {
    const headers = new Headers();
    headers.append('Content-Type', 'application/x-www-form-urlencoded');
    headers.append('Authorization', localStorage.getItem('token'));

    return this._http.get(this._url + '/' + localStorage.getItem('user_id') + '/user/' + offset, { headers: headers })
      .map((response: Response) => response.json());
  }

  getApproverUser(offset) {
    const headers = new Headers();
    headers.append('Content-Type', 'application/x-www-form-urlencoded');
    headers.append('Authorization', localStorage.getItem('token'));

    return this._http.get(this._url + '/' + localStorage.getItem('user_id') + '/user/approval/' + offset, { headers: headers })
      .map((response: Response) => response.json());
  }

  getApproverUserCount(offset) {
    const headers = new Headers();
    headers.append('Content-Type', 'application/x-www-form-urlencoded');
    headers.append('Authorization', localStorage.getItem('token'));

    return this._http.get(this._url + '/' + localStorage.getItem('user_id') + '/user/approval-count/' + offset, { headers: headers })
      .map((response: Response) => response.json());
  }


  getTotal() {
    const headers = new Headers();
    headers.append('Content-Type', 'application/x-www-form-urlencoded');
    headers.append('Authorization', localStorage.getItem('token'));

    return this._http.get(this._url + '/' + localStorage.getItem('user_id') + '/total', { headers: headers })
      .map((response: Response) => response.json());
  }

  getDeletedTotal() {
    const headers = new Headers();
    headers.append('Content-Type', 'application/x-www-form-urlencoded');
    headers.append('Authorization', localStorage.getItem('token'));

    return this._http.get(this._url + '/' + localStorage.getItem('user_id') + '/total/deleted', { headers: headers })
      .map((response: Response) => response.json());
  }

  getActiveTotal() {
    const headers = new Headers();
    headers.append('Content-Type', 'application/x-www-form-urlencoded');
    headers.append('Authorization', localStorage.getItem('token'));

    return this._http.get(this._url + '/' + localStorage.getItem('user_id') + '/total/active', { headers: headers })
      .map((response: Response) => response.json());
  }

  getTotalStaff() {
    const headers = new Headers();
    headers.append('Content-Type', 'application/x-www-form-urlencoded');
    headers.append('Authorization', localStorage.getItem('token'));

    return this._http.get(this._url + '/' + localStorage.getItem('user_id') + '/total/staff', { headers: headers })
      .map((response: Response) => response.json());
  }

  addUsers(data: any) {
    let params = 'data=' + encodeURIComponent(JSON.stringify(data));
    let headers = new Headers();
    headers.append('Content-Type', 'application/x-www-form-urlencoded');
    headers.append('Authorization', localStorage.getItem('token'));

    return this._http.post(this._url + '/' + localStorage.getItem('user_id') + '/user/add', params, { headers: headers })
      .map((response: Response) => response.json());
  }

  deleteUser(id: number) {
    const headers = new Headers();
    headers.append('Authorization', localStorage.getItem('token'));

    return this._http.delete(this._url + '/' + localStorage.getItem('user_id') + '/user/' + id, { headers: headers })
      .map((response: Response) => response.json());
  }

  updateUser(data: any, updateId: any) {
    let params = 'data=' + encodeURIComponent(JSON.stringify(data));
    let headers = new Headers();
    headers.append('Content-Type', 'application/x-www-form-urlencoded');
    headers.append('Authorization', localStorage.getItem('token'));

    return this._http.put(this._url + '/' + localStorage.getItem('user_id') + '/user/' + updateId, params, { headers: headers })
      .map((response: Response) => response.json());
  }
}
