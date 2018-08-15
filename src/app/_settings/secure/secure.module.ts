import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { Routes, RouterModule } from '@angular/router';

import { SecureComponent } from './../../_settings/secure';

import { AuthGuard } from './../../_common/auth.guard';
import { LoginGuard } from './../../_common/login.guard';

const SECURE_ROUTES: Routes = [
    {
        path: '', component: SecureComponent, canActivate: [AuthGuard], children: [
            { path: 'dashboard', canActivate: [LoginGuard], loadChildren: './../../_secure/dashboard/dashboard.module#DashboardModule' },
        ]
    }
];

@NgModule({
    imports: [
        CommonModule,
        RouterModule.forChild(SECURE_ROUTES),

    ],
    declarations: [
        SecureComponent
    ],
    providers: [
        AuthGuard,
        LoginGuard
    ]
})
export class SecureModule { }
