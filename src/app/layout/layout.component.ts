import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { AuthService } from '../services/auth.service';

@Component({
  selector: 'app-layout',
  templateUrl: './layout.component.html',
  styleUrls: ['./layout.component.css']
})
export class LayoutComponent {
  isCollapsed = false;

  constructor(private auth: AuthService, private router: Router){}

  logout(): void {
    this.auth.logout().subscribe(
      ()=> {
      this.router.navigate(['/login'])
    },
     error=> {console.error(error);
    }
    );
  }
}
