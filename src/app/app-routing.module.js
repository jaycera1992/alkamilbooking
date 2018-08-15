"use strict";
var __decorate = (this && this.__decorate) || function(decorators, target, key, desc) {
    var c = arguments.length,
        r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc,
        d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else
        for (var i = decorators.length - 1; i >= 0; i--)
            if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
Object.defineProperty(exports, "__esModule", { value: true });
var core_1 = require("@angular/core");
var router_1 = require("@angular/router");
var auth_guard_1 = require("./_common/auth.guard");
var secure_1 = require("./_settings/secure");
var public_1 = require("./_settings/public");
var routes = [
    { path: '', redirectTo: 'login', pathMatch: 'full', loadChildren: './_public/login/login/login.module#LoginModule' },
    { path: '', component: public_1.PublicComponent, data: { title: 'Public Views' }, children: public_1.PUBLIC_ROUTES },
    { path: '', component: secure_1.SecureComponent, canActivate: [auth_guard_1.AuthGuard], data: { title: 'Secure Views' }, children: secure_1.SECURE_ROUTES },
    { path: '**', redirectTo: 'login' }
];
/**
 * App routing module
 */
var AppRoutingModule = (function() {
    function AppRoutingModule() {}
    return AppRoutingModule;
}());
AppRoutingModule = __decorate([
    core_1.NgModule({
        imports: [
            router_1.RouterModule.forRoot(routes)
        ],
        exports: [router_1.RouterModule]
    })
], AppRoutingModule);
exports.AppRoutingModule = AppRoutingModule;