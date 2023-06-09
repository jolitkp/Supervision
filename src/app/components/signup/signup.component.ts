import { Component } from '@angular/core';
import { HttpClient } from '@angular/common/http';


@Component({
  selector: 'app-signup',
  templateUrl: './signup.component.html',
  styleUrls: ['./signup.component.css']
})

export class SignupComponent {

  public form ={
    nom: null,
    prenom: null,
    email: null,
    password: null,
    password_confirm: null,
    role: null
  };

  public error = null;

  constructor( private http: HttpClient){}



  onSubmit(){
    return this.http.post('http://127.0.0.1:8000/api/signup-page', this.form).subscribe(
      data => console.log(data),
      error => this.handleError(error)
     );
  }

  handleError(error : any) {
    this.error = error.error.error;
  }
}
