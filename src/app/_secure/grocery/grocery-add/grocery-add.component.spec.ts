import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { GroceryAddComponent } from './grocery-add.component';

describe('GroceryAddComponent', () => {
  let component: GroceryAddComponent;
  let fixture: ComponentFixture<GroceryAddComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ GroceryAddComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(GroceryAddComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
