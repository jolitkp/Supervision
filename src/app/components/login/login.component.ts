import { HttpClient } from '@angular/common/http';
import { Component } from '@angular/core';
//import { AuthService } from '../../services/auth.service';


@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent {

  public form = {
    email: null,
    password: null
  };

  public error = null;

  constructor( private http: HttpClient){}

  onSubmit() {
     return this.http.post('http://127.0.0.1:8000/api/login-page', this.form).subscribe(
      data => console.log(data),
      error => console.log(error)
     );
  }
  
  /*handleError(error) {
    this.error = error.error.message;
  }*/
}
