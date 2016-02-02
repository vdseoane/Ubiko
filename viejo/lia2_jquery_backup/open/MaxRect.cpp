/* $Id$ */

/// copyright 2009, Daveed Vandevoorde, Arno Formella, Celso Rodriguez Prada
/// This is totally free software. Do whatever you like with the code.

#include <cassert>
#include <exception>
#include <fstream>
#include <iostream>
#include <utility>
#include <stack>
#include <vector>

/// A simple rectangle class for unsigned int coordinates.
class Rectangle {
private:
  unsigned int xMin;
  unsigned int yMin;
  unsigned int xMax;
  unsigned int yMax;
public:
  /// Note: the default constructor builds an "undefined" rectangle
  /// having minimum coordinates larger than maximum coordinates.
  /// However, its area is computed as 0.
  Rectangle(
  ) :
    xMin(1),
    yMin(1),
    xMax(0),
    yMax(0)
  {
  }
  Rectangle(
    const unsigned int xMin_,
    const unsigned int yMin_,
    const unsigned int xMax_,
    const unsigned int yMax_
  ) :
    xMin(xMin_),
    yMin(yMin_),
    xMax(xMax_),
    yMax(yMax_)
  {
    assert(xMin<=xMax);
    assert(yMin<=yMax);
  }

  /// We declare the following methods as "public commented" to make clear
  /// that we can live with the compiler generated default versions.
  // ~Rectangle();
  // Rectangle(const Rectangle& R);
  // Rectangle& operator=(const Rectangle& R);

  unsigned int XMin(void) const { return xMin; }
  unsigned int YMin(void) const { return yMin; }
  unsigned int XMax(void) const { return xMax; }
  unsigned int YMax(void) const { return yMax; }

  /// Note: a "one point" rectangle has area 1, a default rectangle has
  /// area 0.
  unsigned int Area(void) const {
    return (1+xMax-xMin)*(1+yMax-yMin);
  }
  friend std::ostream& operator<<(
    std::ostream& O,
    const Rectangle& R
  ) {
    O << "Rectangle: "
      << R.xMin << " "
      << R.yMin << " "
      << R.xMax << " "
      << R.yMax << " "
    ;
    return O;
  }
};

/// This is just a simple class to be able to work with different
/// entries in the matrix where we look for the rectangle, for instance,
/// think of a color indexed picture, where we will look for the
/// largest rectangle of a given color. For such an application
/// this Entry class should be modified (or implemented abstractly ...).
class Entry {
  bool value;
public:
  /// We declare the following methods as "public commented" to make clear
  /// that we can live with the compiler generated default versions.
  // Entry();
  // ~Entry();
  // Entry(const Entry& E);
  // Entry& operator=(const Entry& E);
  bool IsSet(void) const { return value; }
  void Set(void) { value=true; }
  void UnSet(void) { value=false; }
};

typedef std::vector<Entry> Row;
typedef std::pair<unsigned int, unsigned int> Interval;

/// This class is what Vandervoorde originally called "cache".
/// I think (Arno) that cache has a "misleading" semantics, rather
/// the profile of the scan is stored.
class Profile {
private:
  std::vector<unsigned int> profile;
private:
  Profile& operator=(const Profile& P);
  Profile(const Profile& P);
public:
  Profile(
    const unsigned int columns
  ) :
    profile(columns+1,0)
  {
  }
  // ~Profile();

  unsigned int operator[](const unsigned int y) {
    assert(y<profile.size());
    return profile[y];
  }
  /// Updates the profile with the next row of the matrix.
  void Update(
    const Row& R
  ) {
    assert(R.size()==profile.size()-1);
    for(
      unsigned int iColumn(profile.size()-1);
      iColumn>0;
    ) {
      if(!R[--iColumn].IsSet())
        profile[iColumn]=0;
      else
        ++profile[iColumn];
    }
  }
};

/// This is a simple matrix just as container for the MaximumRectangle
/// method.
class Matrix {
private:
  unsigned int rows;
  unsigned int columns;
  std::vector<Row> M;

public:
  Matrix(
    const unsigned int rows_,
    const unsigned int columns_
  ) :
    rows(rows_),
    columns(columns_),
    M(rows,Row(columns))
  {
  }
  /// We declare the following methods as "public commented" to make clear
  /// that we can live with the compiler generated default versions.
  // ~Matrix();
  // Matrix(const Matrix& M);
  // Matrix& operator=(const Matrix& M);

  Rectangle MaximumRectangle(
  ) {
    Rectangle best_rectangle;
    Profile profile(columns);
    std::stack<Interval> stack;
    
    for(unsigned int y(0); y<rows ; ++y) {
      profile.Update(M[y]);
      unsigned int width(0);
      for(unsigned int x(0); x<columns+1; ++x) {
	const unsigned int profile_width(profile[x]);

	if(profile_width>width) { // opening new rectangles
	  stack.push(Interval(x,width));
	  width=profile_width;
	} 
	else if(profile_width<width) { // closing rectangles
	  Interval interval;
	  do { 
	    interval=stack.top();
	    stack.pop();
	    const unsigned int area(width*(x-interval.first));
	    if(area>best_rectangle.Area())
	      best_rectangle=Rectangle(interval.first,y-width+1,x-1,y);
	    width=interval.second;
	  } while(profile_width<width);
	  
	  width=profile_width;
	  if(0!=width)
	    stack.push(interval);
	}
      }
    }
    return best_rectangle;
  }

  /// Checks whether the given rectangle is a largest one, i.e.,
  /// all internal points are "set" and at the border there is on
  /// each side at least one point "unset" in the matrix.
  /// Note that we do not check, whether the rectangle actually
  /// is the largest one among all possibilities in the matrix
  /// (this check is done only for the empty rectangle).
  bool Check(
    const Rectangle& R
  ) const {
    if(R.XMax()>=columns) return false;
    if(R.YMax()>=rows) return false;

    // if the rectangle is empty, nothing should be set in the matrix.
    if(R.Area()==0) {
      for(unsigned int y(0);y<rows;++y) {
        const Row& row(M[y]);
        for(unsigned int x(0);x<columns;++x) {
          if(row[x].IsSet()) return false;
        }
      }
      return true;
    }

    // check whether the interior of the rectangle is set.
    for(unsigned int y(R.YMin());y<R.YMax();++y) {
      const Row& row(M[y]);
      for(unsigned int x(R.XMin());x<R.XMax();++x) {
        if(!row[x].IsSet()) return false;
      }
    }

    // check the four borders for at least one unset entry

    bool could_be_larger(true);
    if(0!=R.YMin()) {
      const unsigned int row(R.YMin()-1);
      const unsigned int x_min(R.XMin()>0?R.XMin()-1:0);
      const unsigned int x_max(R.XMax()+1>=columns?R.XMax():R.XMax()+1);
      for(unsigned int i(x_min);i<=x_max;++i) {
        if(!M[row][i].IsSet()) {
          could_be_larger=false;
          break;
        }
      }
      if(could_be_larger) return false;
    }

    could_be_larger=true;
    if(rows-1!=R.YMax()) {
      const unsigned int row(R.YMax()+1);
      const unsigned int x_min(R.XMin()>0?R.XMin()-1:0);
      const unsigned int x_max(R.XMax()+1>=columns?R.XMax():R.XMax()+1);
      for(unsigned int i(x_min);i<=x_max;++i) {
        if(!M[row][i].IsSet()) {
          could_be_larger=false;
          break;
        }
      }
      if(could_be_larger) return false;
    }

    could_be_larger=true;
    if(0!=R.XMin()) {
      const unsigned int col(R.XMin()-1);
      const unsigned int y_min(R.YMin()>0?R.YMin()-1:0);
      const unsigned int y_max(R.YMax()+1>=rows?R.YMax():R.YMax()+1);
      for(unsigned int i(y_min);i<=y_max;++i) {
        if(!M[i][col].IsSet()) {
          could_be_larger=false;
          break;
        }
      }
      if(could_be_larger) return false;
    }

    could_be_larger=true;
    if(columns-1!=R.XMax()) {
      const unsigned int col(R.XMax()+1);
      const unsigned int y_min(R.YMin()>0?R.YMin()-1:0);
      const unsigned int y_max(R.YMax()+1>=rows?R.YMax():R.YMax()+1);
      for(unsigned int i(y_min);i<=y_max;++i) {
        if(!M[i][col].IsSet()) {
          could_be_larger=false;
          break;
        }
      }
      if(could_be_larger) return false;
    }

    return true;
  }

  /// Reads a matrix given as ASCII 0's and 1's and ignores everything else.
  friend std::istream& operator>>(
    std::istream& I,
    Matrix& matrix
  ) {
    // :TODO: should add exceptions for read fails...
    for(
      std::vector<Row>::iterator iRow(matrix.M.begin());
      iRow!=matrix.M.end();
      ++iRow
    ) {
      for(
        Row::iterator iColumn(iRow->begin());
        iColumn!=iRow->end();
        ++iColumn
      ) {
        char c;
LOOP:
        I >> c;
        if(c=='0') iColumn->UnSet();
        else if(c=='1') iColumn->Set();
        else goto LOOP;
      }
    }
    return I;
  }
};

int main(
  int argc,
  char* argv[]
) {
  if(2!=argc) {
    std::cout << "usage:\n\nmax_rect <matrix-file>\n";
    return 1;
  }
  std::cout
    << "this is max_rect\n"
    "an implementation of Vandevoorde\'s maximum rectangle algorithm in C++\n"
  ;

  std::ifstream inM(argv[1]);
  if(!inM) {
    std::cout << "please provide a readable file\n";
    return 1;
  }

  unsigned int columns;
  unsigned int rows;
  inM >> columns >> rows;

  std::cout
    << "will read matrix with "
    << columns << " columns and "
    << rows << " rows.\n"
  ;

  Matrix M(rows,columns);
  inM >> M;
  inM.close();

  std::cout
    << "matrix read.\n"
  ;

  const Rectangle R(M.MaximumRectangle());

  std::cout
    << "largest " << R << "\n"
    << "area " << R.Area() << "\n"
  ;

  if(!M.Check(R)) {
    std::cout << "something is wrong\n";
  }
  else {
    std::cout << "check was fine\n"
      "(at least the rectangle is not expandable and its interior is set)\n"
    ;
  }
  return 0;
}

