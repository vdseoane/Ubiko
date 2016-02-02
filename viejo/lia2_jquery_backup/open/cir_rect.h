/* $Id$ */

/*
 * area of intersection of a circle with a rectangle
 * copyright (c) 2003, Arno Formella, Thorsten Poeschel
 *
 * This program is free software; you can do with it whatever you want to.
 *
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

#ifndef CIR_RECT_H
#define CIR_RECT_H

// returns area of intersection of circle and rectangle
// radius must be strictly positive, ie., r>0.0
// rectangle must be well defined, ie., R_l<R_r and R_d<R_u
double AreaIntersectionCircleRectangle(
  const double C_x,  // center of circle
  const double C_y,
  const double r,    // radius of circle
  const double R_l,  // left, right, down and up of rectangle
  const double R_r,
  const double R_d,
  const double R_u
);

#endif

