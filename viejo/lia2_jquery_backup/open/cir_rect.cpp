/*
 * area of intersection of a circle with a rectangle
 * copyright (c) 2003, Arno Formella, Thorsten Poeschel
 * corrected version 2011.
 *
 * This program is free software; you can do with it whatever you want to.
 *
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

#include <iostream>
#include <cmath>
#include <cassert>

using namespace std;

// returns area of segment given radius and chord length
// precondition: chord length is less than or equal to diameter
static double AreaSegment(
  const double r,  // radius of circle
  const double a   // chord length
) {
  assert(r>0.0);    // check preconditions
  assert(a>=0.0);
  assert(a<=2.0*r);

  const double h(a/(2.0*r));
  const double alpha(asin(h));  // twice the sector angle
  return r*r*(alpha-h*cos(alpha));
}

// returns the area of the intersection of a circle with the quadrant of
// the plane below x and to the right of y
// precondition: (x,y) within bounding box of the circle
static double AreaQuadrant(
  const double C_x,  // center of circle
  const double C_y,
  const double r,    // radius of circle
  const double x,    // point defining quadrant
  const double y
) {
  assert(r>0.0);
  // we cannot check the preconditions because of Intels 80 bit arithmetic
  // assert(x>=C_x-r);  // check preconditions
  // assert(x<=C_x+r);
  // assert(y>=C_y-r);
  // assert(y<=C_y+r);

  const double r2(r*r);        // square of radius
  const double dx(C_x-x);      // x-distance of point from center
  const double dx2(dx*dx);     // square x-distance of point from center
  const double dy(C_y-y);      // y-distance of point from center
  const double dy2(dy*dy);     // square y-distance of point from center
  const double d2(dx2+dy2);    // square distance of point from center
  if(d2>r2) { // point outside of circle
    // distinguish the four corners
    if(x>C_x) {
      if(y>C_y) { // upper right corner
        return 0.0;  // no intersection
      }
      else {
        // right cut
        const double d(r2-dx2);
        return AreaSegment(r,2.0*sqrt(d<0.0?0.0:d));
      }
    }
    else {
      if(y>C_y) { // upper left corner
        // only lower cut
        const double e(r2-dy2);
        return AreaSegment(r,2.0*sqrt(e<0.0?0.0:e));
      }
      else { // lower left corner
        const double d(r2-dx2);
        const double e(r2-dy2);
        return M_PI*r2-   // whole circle
            // left cut
          AreaSegment(r,2.0*sqrt(d<0.0?0.0:d))-
            // upper cut
          AreaSegment(r,2.0*sqrt(e<0.0?0.0:e));
      }
    }
  }
  else { // point inside of circle
    // compute distances from point to circle
    // cout << "dx=" << dx << endl;
    // cout << "dy=" << dy << endl;
    // cout << "r2=" << r2 << endl;
    // cout << "d2=" << d2 << endl;
    const double d(r2-dy2);
    const double D_x=sqrt(d<0.0?0.0:d)+dx;
    const double e(r2-dx2);
    const double D_y=sqrt(e<0.0?0.0:e)+dy;
    // cout << "D_x=" << D_x << endl;
    // cout << "D_y=" << D_y << endl;
    return
      AreaSegment(r,sqrt(D_x*D_x+D_y*D_y))  // segment
      +0.5*D_x*D_y;                         // triangle
  }
}

// returns area of intersection of circle and rectangle
// radius must be strictly positive
// rectangle must be well defined, ie., R_l<R_r and R_d<R_u
double AreaIntersectionCircleRectangle(
  const double C_x,  // center of circle
  const double C_y,
  const double r,    // radius of circle
  const double R_l,  // left, right, up and down of rectangle
  const double R_r,
  const double R_d,
  const double R_u
) {
  assert(r>0.0);
  assert(R_l<R_r);
  assert(R_d<R_u);

    // compute bounding box of circle
  const double C_l(C_x-r);
  const double C_r(C_x+r);
  const double C_d(C_y-r);
  const double C_u(C_y+r);
    // check whether bounding box and rectangle intersect
  if(R_l>=C_r||R_r<=C_l||R_d>=C_u||R_u<=C_d) return 0.0;
    // compute intersection of bounding box and rectangle
  const double B_l(R_l<C_l?C_l:R_l);
  const double B_r(R_r>C_r?C_r:R_r);
  const double B_d(R_d<C_d?C_d:R_d);
  const double B_u(R_u>C_u?C_u:R_u);
    // return area by adding and subtracting
    // the appropriate quadrant intersections
  return
    AreaQuadrant(C_x,C_y,r,B_l,B_u)+
    AreaQuadrant(C_x,C_y,r,B_r,B_d)-
    AreaQuadrant(C_x,C_y,r,B_l,B_d)-
    AreaQuadrant(C_x,C_y,r,B_r,B_u);
}

#ifdef STAND_ALONE

int main(
) {
  // just a few test cases, not an exhaustive test !!!
  // you are free to complete :-)
  // bug report appreciated (formella@ei.uvigo.es)

  const double lxmin(0.0);     //lattice boundaries
  const double lxmax(10.0);
  const double lymin(0.0);
  const double lymax(10.0);
  const double lresx(6.0);     //lattice resolution
  const double lresy(6.0);

  const double dx((lxmax-lxmin)/lresx);
  const double dy((lymax-lymin)/lresy);
  const double C_r(3.5);
  const double C_x(5.0);
  const double C_y(4.0);

  double A(0);

  for(int ix(0); ix<lresx; ix++) {
    for(int iy(0); iy<lresy; iy++) {
      const double xmin(lxmin+ix*dx);
      const double ymin(lymin+iy*dy);
      A += AreaIntersectionCircleRectangle(C_x,C_y,C_r,
        xmin,xmin+dx,ymin,ymin+dy);
      cout
        << xmin << " "
        << ymin << " "
        << xmin+dx << " "
        << ymin+dy << " "
        << A << endl;
    }
  }
  cout << A << " =?= " << M_PI*C_r*C_r << endl;

  const double x=168.115309, y=127.529398, R=0.5;
  const double xbmin=160, xbmax=170, ybmin=120, ybmax=130;

  cout <<
    AreaIntersectionCircleRectangle(x,y,R,xbmin,xbmax,ybmin,ybmax)<< endl;

}

#endif

