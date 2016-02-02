% ---------------------------------------------------------------------------- %
% We start out with the standard LaTeX document class "article" or "report" and
% modify it so it conforms to what we want.
%
% This document has been built taking a close look at SANDIA Reports
% (http://www.cs.sandia.gov/~rolf/SANDreport)
%
% (c) copyright 2010, Arno Formella
%

% ******************************************************************************
% Package definitions
%
% The version and date of this file
% leave the spaces before and after version
\newcommand\LiaUniLetterClsVersionOnly{ v1.10 }
% Date has to be in this format!
\newcommand\LiaUniLetterClsVersionDate{2010/25/12}

\newcommand\LiaUniLetterClsVersion{%
\LiaUniLetterClsVersionDate \LiaUniLetterClsVersionOnly}
\ProvidesClass{lia_uni_letter}[\LiaUniLetterClsVersion Arno Formella]
\ProvidesFile{lia_uni_letter.cls}[\LiaUniLetterClsVersion Arno Formella]

\NeedsTeXFormat{LaTeX2e}

% We need ifthenelse. \newboolean are false by default
\RequirePackage{ifthen}
\RequirePackage{color}
\definecolor{ColCampusOU}{rgb}{0.38,0.75,0.11}
\definecolor{ColInvestigation}{rgb}{0,0.7,0.73}
\RequirePackage{graphicx}
\RequirePackage{fancyhdr}
\RequirePackage{units}
\RequirePackage{lastpage}
\RequirePackage{afterpage}
\RequirePackage{pdfpages}
\RequirePackage{marginnote}

% Variables for mandatory declarations
\newboolean{LiaAuthorProvided}
\newboolean{LiaPhoneProvided}
\newboolean{LiaEmailProvided}
\newboolean{LiaWebProvided}

\DeclareOption{twocolumn}{\OptionNotUsed}

\DeclareOption*{\PassOptionsToClass{\CurrentOption}{article}}
\ProcessOptions\relax
\LoadClass[onecolumn]{article}

\RequirePackage{sectsty}
\setcounter{secnumdepth}{5}
\setcounter{tocdepth}{5}

\RequirePackage{geometry}
\geometry{
  a4paper,
  pdftex,
  right=1.5cm,
  textwidth=16cm,
  headheight=3.8cm,
  textheight=24.4cm,
  marginparwidth=2.6cm,
  marginparsep=0.4cm,
  voffset=0.7cm,
  reversemp=true
}

\RequirePackage{longtable}
\RequirePackage{colortbl}
\RequirePackage{datetime}
\RequirePackage{caption}
\setlength{\belowcaptionskip}{2ex}

\AtBeginDocument{
% Do some usage checking
  \ifthenelse{\boolean{LiaAuthorProvided}}   {
    \hypersetup{pdfauthor=\LiaAuthorVar}
  }{
    \ClassError{lia_uni_letter.cls}{Author not provided}
    {Insert \@backslashchar LiaAuthor in the preamble of your document}
  }
  \ifthenelse{\boolean{LiaPhoneProvided}}   {
  }{
    \ClassError{lia_uni_letter.cls}{Phone number not provided}
    {Insert \@backslashchar LiaPhone in the preamble of your document}
  }
  \ifthenelse{\boolean{LiaEmailProvided}}{
  }{
    \ClassError{lia_uni_letter.cls}{Email address not provided}
    {Insert \@backslashchar LiaEmail in the preamble of your document}
  }

  \ifthenelse{\boolean{LiaWebProvided}}{
  }{
    \ClassError{lia_uni_letter.cls}{Web address not provided}
    {Insert \@backslashchar LiaWeb in the preamble of your document}
  }


% Save the title, it will be cleared by \maketitle, but we need it later in
% the header
  %\newsavebox{\LiaHeaderTitle}
  %\savebox{\LiaHeaderTitle}{\LiaFont{m}{10}{10pt}\sffamily \@title}

  \hypersetup{pdftitle=\@title}

  \setlength{\headwidth}{18cm}
  \renewcommand{\headrule}{}
  \setlength\parskip{1.5ex}
  \pagestyle{fancy}
}

\newcommand{\LiaFontBase}[3]{%
\fontencoding{OT1}%
\fontfamily{ptm}%
\fontseries{#1}%
\fontshape{n}%
\fontsize{#2}{#3}%
\selectfont%
}

\newcommand{\LiaFontInvestigation}[4]{%
\fontencoding{OT1}%
\fontfamily{ptm}%
\fontseries{#1}%
\fontshape{#2}%
\fontsize{#3}{#4}%
\selectfont%
\color{ColInvestigation}%
}

\newcommand{\LiaFontOurense}[4]{%
\fontencoding{OT1}%
\fontfamily{ptm}%
\fontseries{#1}%
\fontshape{#2}%
\fontsize{#3}{#4}%
\selectfont%
\color{ColCampusOU}%
}

\newcommand{\LiaAddress}{
  \fancyfoot{} % Clear all foot markings
  \fancyhead{} % Clear all head markings
  \thispagestyle{fancy}
  \renewcommand{\headrule}{}

  \lhead{%
    \hrule width 18cm height 0.3pt\vskip3pt
    \setlength{\tabcolsep}{0pt}
    \begin{tabular}{p{8.5cm}p{10cm}}
    \raisebox{-5pt}{\usebox{\LiaHeadLogo}}
    &
    {\parbox[t][0cm][b]{10cm}{
      \begin{tabular}{p{3.75cm}p{3.4cm}p{3cm}}
      \raggedright\LiaFontInvestigation{m}{it}{10}{10pt} Campus de Ourense &
      \raggedright\LiaFontInvestigation{m}{n}{11}{11pt}
      Escola Superior\quad\quad de Enxe\~nar\'ia Inform\'atica &
      \raggedright\LiaFontInvestigation{m}{n}{11}{11pt}
      Laboratorio de Inform\'atica Aplicada
      \end{tabular}
    }}
    \end{tabular}%
  }
  \LiaPageNumber
  \vskip-0.5cm
  \hfill\rule{9.5cm}{0.3pt}

  \hfill\parbox{9.45cm}{%
  \vskip-0.2cm
  \LiaFontBase{n}{10}{10pt}
  \setlength{\tabcolsep}{0pt}
%  \begin{tabular}{p{3cm}p{6.4cm}}
%  \LiaAuthorVar &  {\hfill Tel. \LiaPhoneVar}\\
%  Edificio Polit\'ecnico & {\hfill Fax. 988 387 001}\\
%  As Lagoas s/n  & {\hfill \LiaEmailVar}\\
%  32004 Ourense & {\hfill \LiaWebVar}
%  \end{tabular}
  \begin{tabular}{l}
  \LiaAuthorVar\\
  Edificio Polit\'ecnico \\
  As Lagoas s/n \\
  32004 Ourense 
  \end{tabular}\hfill
  \begin{tabular}{r}
  Tel. \LiaPhoneVar\\
  Fax. 988 387 001\\
  \LiaEmailVar\\
  \LiaWebVar
  \end{tabular}
  }
  \vskip0.3cm
  \noindent\rule{6.1cm}{0.3pt}\hspace{0.4cm}\rule{9.5cm}{0.3pt}
  \vskip0.5cm
}

% Here we define the mandatory declarations
\newcommand{\LiaAuthor}[1]{
  \newcommand{\LiaAuthorVar}{#1}
  \setboolean{LiaAuthorProvided}{true}
}

\newcommand{\LiaPhone}[1]{
  \newcommand{\LiaPhoneVar}{#1}
  \setboolean{LiaPhoneProvided}{true}
}

\newcommand{\LiaEmail}[1]{
  \newcommand{\LiaEmailVar}{#1}
  \setboolean{LiaEmailProvided}{true}
}

\newcommand{\LiaWeb}[1]{
  \newcommand{\LiaWebVar}{#1}
  \setboolean{LiaWebProvided}{true}
}


% Here we define the optional declarations
\newcommand{\LiaDateVar}{\ddmmyyyydate\today}
\newcommand{\LiaDate}[1]{
  \renewcommand{\LiaDateVar}{#1}
}

\newcommand{\LiaPageNumber}{%
\lfoot{\usebox{\LiaFootLogo}}\rfoot{\thepage\ de \pageref{LastPage}}}
\newcommand{\LiaPageOfPage}{\LiaPageNumber}
\newcommand{\LiaSimplePageNumber}{\renewcommand{\LiaPageNumber}{%
\lfoot{\usebox{\LiaFootLogo}}\rfoot{\thepage}}}
\newcommand{\LiaNoPageNumber}{\renewcommand{\LiaPageNumber}{%
\lfoot{\usebox{\LiaFootLogo}}}}

\renewcommand{\@maketitle}{
  \LiaAddress
}

\renewcommand{\maketitle}{\par
  \begingroup              % from article.cls
    \renewcommand\thefootnote{\@fnsymbol\c@footnote}%    % from article.cls
    \def\@makefnmark{            % from article.cls
      \rlap{\@textsuperscript{\normalfont\@thefnmark}}
    }%  % from article.cls
    \long\def\@makefntext##1{\parindent 1em\noindent    % from article.cls
      \hb@xt@1.8em{%            % from article.cls
      \hss\@textsuperscript{\normalfont\@thefnmark}}##1
    }%  % from article.cls
    \if@twocolumn            % from article.cls
      \ifnum \col@number=\@ne          % from article.cls
        \@maketitle            % from article.cls
      \else              % from article.cls
        \twocolumn[\@maketitle]%        % from article.cls
      \fi              % from article.cls
    \else              % from article.cls
      %\newpage            % from article.cls
    % Prevents figures from going at top of page.    % from article.cls
      \global\@topnum\z@          % from article.cls
      \@maketitle            % from article.cls
    \fi                % from article.cls
    %\LiaMarks            % new
    \@thanks              % from article.cls
  \endgroup              % from article.cls
  \setcounter{footnote}{0}%          % from article.cls
  \global\let\thanks\relax          % from article.cls
  \global\let\maketitle\relax          % from article.cls
  \global\let\@maketitle\relax        % from article.cls
  \global\let\@thanks\@empty          % from article.cls
  \global\let\@author\@empty          % from article.cls
  \global\let\@date\@empty          % from article.cls
  \global\let\@title\@empty          % from article.cls
  \global\let\title\relax          % from article.cls
  \global\let\author\relax          % from article.cls
  \global\let\date\relax          % from article.cls
  \global\let\and\relax          % from article.cls

      % Now we renew \newpage so that from here on the markings
      % of the body are used.
  \renewcommand{\newpage}{%        % \newpage from latex.ltx
    \if@noskipsec          % \newpage from latex.ltx
      \ifx \@nodocument\relax      % \newpage from latex.ltx
        \leavevmode        % \newpage from latex.ltx
        \global \@noskipsecfalse    % \newpage from latex.ltx
      \fi            % \newpage from latex.ltx
    \fi            % \newpage from latex.ltx
    \if@inlabel          % \newpage from latex.ltx
      \leavevmode          % \newpage from latex.ltx
      \global \@inlabelfalse      % \newpage from latex.ltx
    \fi            % \newpage from latex.ltx
    \if@nobreak \@nobreakfalse \everypar{}\fi  % \newpage from latex.ltx
    \par            % \newpage from latex.ltx
    \vfil            % \newpage from latex.ltx
    \penalty -\@M          % \newpage from latex.ltx
    %\LiaMarks        % new
  }              % \newpage from latex.ltx
  \vspace{0.5cm}
}                % \maketitle from article.sty

% head and foot lines
\newsavebox{\LiaHeadLogo}
\savebox{\LiaHeadLogo}{
\parbox[c]{6.5cm}{\includegraphics[width=6.5cm]{UniDeVigo_2067x367}}%
}
\newsavebox{\LiaFootLogo}
\savebox{\LiaFootLogo}{
\parbox[b]{1.0cm}{\includegraphics[width=1.0cm]{logo_lia_large_75}}%
}

\newcommand{\LiaMarks}{
  \fancyfoot{} % Clear all foot markings
  \fancyhead{} % Clear all head markings
  \pagestyle{fancy}
  \thispagestyle{fancy}

  \lhead{%
    \hrule width 19cm height 0.3pt\vskip3pt
    \setlength{\tabcolsep}{0pt}
    \begin{tabular}{p{9.3cm}p{10cm}}
    \raisebox{0.05cm}{\usebox{\LiaHeadLogo}}
    &
    \raisebox{0.5cm}{%
      \LiaFontOurense{m}{n}{11}{11pt}
      Escola Superior de Enxe\~nar\'ia Inform\'atica
    }
    \end{tabular}%
  }
  \LiaPageNumber
}

\RequirePackage{hyperref}
\hypersetup{
  %bookmarks=true,         % show bookmarks bar?
  citecolor=green,        % color of links to bibliography
  colorlinks=true,       % false: boxed links; true: colored links
  filecolor=magenta,      % color of file links
  linkcolor=blue,          % color of internal links
  %pagebackref=true,
  pdfauthor={Arno Formella},     % author
  pdfcreator={Latex with LIA-uni-letter class},   % creator of the document
  pdffitwindow=true,      % page fit to window when opened
  pdfkeywords={}, % list of keywords
  pdfmenubar=true,        % show Acrobat’s menu?
  pdfnewwindow=true,      % links in new window
  pdfproducer={Arno Formella}, % producer of the document
  pdfsubject={LIA document},   % subject of the document
  %pdftex,
  pdftitle={LIA Document},    % title
  pdftoolbar=true,        % show Acrobat’s toolbar?
  unicode=false,          % non-Latin characters in Acrobat’s bookmarks
  urlcolor=cyan           % color of external links
}

%\AtEndDocument{
%\label{lastpagenumber}
%}

\setlength\leftmargini  {17\p@}
\setlength\leftmargin    {\leftmargini}
\setlength\leftmarginii  {\leftmargini}
\setlength\leftmarginiii {\leftmargini}
\setlength\leftmarginiv  {\leftmargini}
\setlength  \labelsep  {.5em}
\setlength  \labelwidth{\leftmargini}
\addtolength\labelwidth{-\labelsep}

\def\@listI{\leftmargin\leftmargini
            \parsep 0\p@ \@plus1\p@ \@minus\p@
            \topsep 8\p@ \@plus2\p@ \@minus4\p@
            \itemsep0\p@}
\let\@listi\@listI
\@listi
\def\@listii {\leftmargin\leftmarginii
              \labelwidth\leftmarginii
              \advance\labelwidth-\labelsep
              \topsep    0\p@ \@plus2\p@ \@minus\p@}
\def\@listiii{\leftmargin\leftmarginiii
              \labelwidth\leftmarginiii
              \advance\labelwidth-\labelsep
              \topsep    0\p@ \@plus\p@\@minus\p@
              \parsep    \z@
              \partopsep \p@ \@plus\z@ \@minus\p@}

\newcommand{\LiaSign}[2]{
\vspace*{0.5cm}
\noindent Ourense, #1

\vspace*{1.5cm}

\noindent\LiaAuthorVar\\
\noindent#2
}

%\renewcommand\labelitemi{\normalfont\bfseries --}
%\renewcommand\labelitemii{$\m@th\bullet$}

