import { Component } from '@angular/core';
import { AuthService } from 'src/app/services/auth.service';

@Component({
  selector: 'app-forgot-password',
  templateUrl: './forgot-password.component.html',
  styleUrls: ['./forgot-password.component.css']
})
export class ForgotPasswordComponent {
  email: string = '';
  


  constructor(private auth: AuthService){}


  submitForm(){
    /*this.auth.forgotPassword(this.email).subscribe(
      () => {

      },
      error => {
        console.error(error);
        
      }
    );*/
  }
}
