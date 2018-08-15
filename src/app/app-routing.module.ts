import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { CommonModule } from '@angular/common';
import { AuthGuard } from './_common/auth.guard';

import { PublicComponent } from './_settings/public';

const routes: Routes = [
    { path: '', redirectTo: 'login', pathMatch: 'full' },
    /* { path: '', redirectTo: 'maintenance', pathMatch: 'full' }, */
    { path: '', component: PublicComponent, loadChildren: './_settings/public/public.module#PublicModule' },
    { path: '', loadChildren: './_settings/secure/secure.module#SecureModule' },
];

/**
 * App routing module
 */
@NgModule({
    imports: [
        CommonModule,
        RouterModule.forRoot(routes, { useHash: true }),
    ],
    declarations: [
        PublicComponent,
    ],
    exports: [RouterModule]
})
export class AppRoutingModule { }
