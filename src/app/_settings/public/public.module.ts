import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { Routes, RouterModule } from '@angular/router';

const PUBLIC_ROUTES: Routes = [
    { path: '', redirectTo: 'login', pathMatch: 'full' },
    { path: 'login', loadChildren: './../../_public/login/login/login.module#LoginModule' }
];

@NgModule({
    imports: [
        CommonModule,
        RouterModule.forChild(PUBLIC_ROUTES)
    ],
    declarations: [
    ],
    exports: [
    ]
})
export class PublicModule { }