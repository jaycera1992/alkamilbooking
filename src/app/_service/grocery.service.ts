import { Injectable } from '@angular/core';
import { Http, Response, Headers, URLSearchParams } from '@angular/http';
import 'rxjs/add/operator/map';

import { AppSettings } from '../app.settings';

@Injectable()
export class GroceryService {

  private _url: string = AppSettings.API_ENDPOINT + 'secure';

  constructor(private _http: Http) { }

  addCategory(data: any) {
    let params = 'data=' + encodeURIComponent(JSON.stringify(data));
    let headers = new Headers();
    headers.append('Content-Type', 'application/x-www-form-urlencoded');
    headers.append('Authorization', localStorage.getItem('token'));

    return this._http.post(this._url + '/' + localStorage.getItem('user_id') + '/category/add', params, { headers: headers })
      .map((response: Response) => response.json());
  }

  addCategoryData(data: any) {
    let params = 'data=' + encodeURIComponent(JSON.stringify(data));
    let headers = new Headers();
    headers.append('Content-Type', 'application/x-www-form-urlencoded');
    headers.append('Authorization', localStorage.getItem('token'));

    return this._http.post(this._url + '/' + localStorage.getItem('user_id') + '/category/add-grocery', params, { headers: headers })
      .map((response: Response) => response.json());
  }

  getCategory(offset) {
    const headers = new Headers();
    headers.append('Content-Type', 'application/x-www-form-urlencoded');
    headers.append('Authorization', localStorage.getItem('token'));

    return this._http.get(this._url + '/' + localStorage.getItem('user_id') + '/category/' + offset, { headers: headers })
      .map((response: Response) => response.json());
  }

  getCategoryTotal() {
    const headers = new Headers();
    headers.append('Content-Type', 'application/x-www-form-urlencoded');
    headers.append('Authorization', localStorage.getItem('token'));

    return this._http.get(this._url + '/' + localStorage.getItem('user_id') + '/category/total/category', { headers: headers })
      .map((response: Response) => response.json());
  }

  getCategoryReference() {
    const headers = new Headers();
    headers.append('Content-Type', 'application/x-www-form-urlencoded');
    headers.append('Authorization', localStorage.getItem('token'));

    return this._http.get(this._url + '/' + localStorage.getItem('user_id') + '/category/get-reference', { headers: headers })
      .map((response: Response) => response.json());
  }

  getCategoryTotalById(id: any) {
    const headers = new Headers();
    headers.append('Content-Type', 'application/x-www-form-urlencoded');
    headers.append('Authorization', localStorage.getItem('token'));

    return this._http.get(this._url + '/' + localStorage.getItem('user_id') + '/category/total/category/' + id, { headers: headers })
      .map((response: Response) => response.json());
  }

}
