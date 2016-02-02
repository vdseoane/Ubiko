% ---------------------------------------------------------------------------- %
% We start out with the standard LaTeX document class "article" or "report" and
% modify it so it conforms to what we want.
%
% This document has been built taking a close look at SANDIA Reports
% (http://www.cs.sandia.gov/~rolf/SANDreport)
%
% (c) copyright 2009-2010, Arno Formella
%

% ******************************************************************************
% Package definitions
%
% The version and date of this file
% leave the spaces before and after version
\newcommand\LiaClsVersionOnly{ v1.20 }
% Date has to be in this format!
\newcommand\LiaClsVersionDate{2010/25/12}

\newcommand{\Lia}{{\bfseries\sffamily LIA}}
\newcommand{\LiaTBD}[1]{{\bfseries TBD}\addcontentsline{lod}{10}{#1}}
\newcommand{\ACR}[1]{{\bfseries #1}\label{acr:#1}}
\newcommand{\rACR}[1]{\hyperref[acr:#1]{#1}}

\newcommand\LiaClsVersion{\LiaClsVersionDate \LiaClsVersionOnly}
\ProvidesClass{lia}[\LiaClsVersion Arno Formella]
\ProvidesFile{lia.cls}[\LiaClsVersion Arno Formella]

\NeedsTeXFormat{LaTeX2e}

% We need ifthenelse. \newboolean are false by default
\RequirePackage{ifthen}

% our LIA colors
\RequirePackage{color}
\definecolor{LiaRed}{rgb}{1.0,0.0,0.0}
\definecolor{LiaGreen}{rgb}{0.0,0.82,0.0}
\definecolor{LiaBlue}{rgb}{0.0,0.0,1.0}
\definecolor{LiaBaseColor}{rgb}{0.0,0.0,0.0}

% some more packages we require
\RequirePackage{graphicx}
\RequirePackage{fancyhdr}
\RequirePackage{units}
\RequirePackage{lastpage}
\RequirePackage{afterpage}
\RequirePackage{pdfpages}
\RequirePackage{marginnote}

% Variables for mandatory declarations
\newboolean{LiaAuthorProvided}
\newboolean{LiaVersionProvided}
\newboolean{LiaNumberProvided}
\newboolean{LiaNoTableOfContentsProvided}
\newboolean{LiaListOfFiguresProvided}
\newboolean{LiaListOfTablesProvided}
\newboolean{LiaListOfTBDProvided}

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
  right=72pt,
  textwidth=378pt,
  headheight=36pt,
  textheight=612pt,
  marginparwidth=78pt,
  marginparsep=15pt,
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
    \ClassError{lia.cls}{\@backslashchar Author not provided}
    {Insert \@backslashchar LiaAuthor in the preamble of your document}
  }
  \ifthenelse{\boolean{LiaVersionProvided}}   {
  }{
    \ClassError{lia.cls}{\@backslashchar Version not provided}
    {Insert \@backslashchar LiaVersion in the preamble of your document}
  }
  \ifthenelse{\boolean{LiaNumberProvided}}{
  }{
    \ClassError{lia.cls}{\@backslashchar Document Number not provided}
    {Insert \@backslashchar Document Number in the preamble of your document}
  }

% Save the title, it will be cleared by \maketitle, but we need it later in
% the header
  \newsavebox{\LiaHeaderTitle}
  \savebox{\LiaHeaderTitle}{\LiaFont{m}{10}{10pt}\sffamily \@title}
  \hypersetup{pdftitle=\@title}

% give head rule width
  \setlength{\headwidth}{475pt}
  \newlength{\hrulewidth}
  \setlength{\hrulewidth}{475pt}
  \renewcommand{\headrulewidth}{0.5pt}
  \renewcommand{\headrule}{\color{LiaBaseColor}%
  \hrule width \hrulewidth height\headrulewidth \vskip-\headrulewidth}

  \renewcommand{\sectionrule}[5]{%
    \SS@oclto{1}{No KOMA-script; normal section rule}%
    \let\SS@@par\@@par\let\@@par\relax% very dodgy
    \noindent\makebox[0pt][l]{\rule[#1]{\hsize}{#2}}%
      #5\hfill\color{LiaBaseColor}\makebox[0pt][r]{\rule[#3]{\hsize}{#4}}%
  }

  \sectionfont{\LiaFont{m}{18}{18pt}\sectionrule{0pt}{0pt}{-1ex}{1.5pt}}
  \subsectionfont{\LiaFont{m}{14.4}{15pt}\sectionrule{0pt}{0pt}{-0.8ex}{1pt}}
  \subsubsectionfont{\LiaFont{m}{12}{14pt}\sectionrule{0pt}{0pt}{-0.6ex}{0.7pt}}
  \paragraphfont{\LiaFont{m}{11}{11pt}}
  \subparagraphfont{\LiaFont{m}{10}{10pt}}

  \setlength\parskip{1.5ex}
  \LiaFont{m}{10}{11pt}
  \pagestyle{fancy}
}

% Font selections \LiaFont{series}{size}{skip}
\newcommand{\LiaFont}[3]{%
\fontencoding{OT1}%
\fontfamily{ptm}%
\fontseries{#1}%
\fontshape{n}%
\fontsize{#2}{#3}%
\selectfont%
}
\usepackage{mathptmx}
\renewcommand{\ttfamily}{%
%\fontencoding{OT1}%
\fontfamily{pcr}%
%\fontseries{m}%
%\fontshape{n}%
%\fontsize{10}{11pt}%
\selectfont%
}
\newcommand{\LiaFontBaseColor}[3]{%
\fontencoding{OT1}%
\fontfamily{ptm}%
\fontseries{#1}%
\fontshape{n}%
\fontsize{#2}{#3}%
\selectfont%
\color{LiaBaseColor}%
}
\newcommand{\LiaFontWhite}[3]{%
\fontencoding{OT1}%
\fontfamily{ptm}%
\fontseries{#1}%
\fontshape{n}%
\fontsize{#2}{#3}%
\selectfont%
\color{white}%
}

%\newcommand{\LiaRowColor}{\rowcolor[rgb]{0.0,0.45,1.0}}
%\newcommand{\LiaColumnColor}{\columncolor[rgb]{0.0,0.45,1.0}}

\newcommand{\LiaFrontPages}{
  %\LiaMarks
  \newlength{\parindentsave}
  \setlength{\parindentsave}{\parindent}
  \setlength{\parindent}{0em}
  \thispagestyle{empty}
  \centering{\includegraphics[width=3.5cm]{logo_lia_Large_316}}
  \begin{minipage}[t]{378pt} %\textwidth}
  \begin{center}
    \vspace{2cm}
    \LiaFont{b}{18}{20pt}\@title
    \vspace{2cm}\\
    \LiaFont{b}{14}{14pt}\LiaSubTitleVar
  \end{center}
  \end{minipage}
  \vfill 
  \begin{minipage}[b]{190pt} %{0.5\textwidth}
  \Lia\\
  Universidade de Vigo\\
  Escola Superior de Enxe\~nar\'{\i}a Inform\'atica\\
  E--32004 Ourense\\[\baselineskip]
  \url{http://lia.ei.uvigo.es}\\
  \url{mailto:formella@uvigo.es}\\[\baselineskip]
  Contact: Arno Formella%
  \end{minipage}\hfill\begin{minipage}[b]{180pt} %{0.4\textwidth}
  \hfill\begin{tabular}[b]{rr}
  Reference: & \LiaNumberVar \\
  Version: & \LiaVersionVar \\
  Date: & \LiaDateVar \\
  Pages: & \pageref{LastPage}
  \end{tabular}
  \end{minipage} 
%  \newpage
%  \LiaMarks
%  \begin{center}\begin{minipage}[t]{13cm}
%  \begin{centering}
%    \LiaFontBaseColor{m}{9}{10pt}
%    \setlength\parskip{2ex}
%    
%    \Lia\ owns the copyright of this document which is
%    supplied in confidence and which shall not be used for any purpose
%    other than that for which it is supplied and shall not in whole or
%    in part be reproduced, copied or communicated to any person without
%    permission from the owner.
%    
%    Any person other than the authorised holder obtaining possession of 
%    this document by finding or otherwise, should send it, together with
%    his name and address, in a sealed envelope to:
%
%    Letter postage need not be prepaid.
%    Other postages will be refunded.\\
%  \end{centering}
%  \end{minipage}\end{center}

  \newpage
  \LiaMarks
  \ifthenelse{\boolean{LiaNoTableOfContentsProvided}}{
  }{
    \newlength{\parskipsave}
    \setlength{\parskipsave}{\parskip}
    \parskip0.5ex plus0.2ex minus0.2ex
    \tableofcontents
    \setlength{\parskip}{\parskipsave}
  }
  \ifthenelse{\boolean{LiaListOfTBDProvided}}{
    \newpage
    \listoftbd
  }{
  }
  \ifthenelse{\boolean{LiaListOfFiguresProvided}}{
    \newpage
    \listoffigures
  }{
  }
  \ifthenelse{\boolean{LiaListOfTablesProvided}}{
    \newpage
    \listoftables
  }{
  }
 
  % Restore the original paragraph indent
  \setlength{\parindent}{\parindentsave}
}

% Here we define the mandatory declarations
\newcommand{\LiaNumber}[1]{
  \newcommand{\LiaNumberVar}{#1}
  \setboolean{LiaNumberProvided}{true}
}

\newcommand{\LiaVersion}[1]{
  \newcommand{\LiaVersionVar}{#1}
  \setboolean{LiaVersionProvided}{true}
}

\newcommand{\LiaWrittenBy}[1]{
  \newcommand{\LiaAuthorVar}{#1}
  \setboolean{LiaAuthorProvided}{true}
}

% Here we define the optional declarations
\newcommand{\LiaDateVar}{\ddmmyyyydate\today}
\newcommand{\LiaDate}[1]{
  \renewcommand{\LiaDateVar}{#1}
}

\newcommand{\LiaSubTitleVar}{}
\newcommand{\LiaSubTitle}[1]{
  \renewcommand{\LiaSubTitleVar}{#1}
}

\newcommand{\LiaNoTableOfContents}{
  \setboolean{LiaTableOfContentsProvided}{false}
}
\newcommand{\LiaListOfTBD}{
  \setboolean{LiaListOfTBDProvided}{true}
}
\newcommand{\LiaListOfTables}{
  \setboolean{LiaListOfTablesProvided}{true}
}
\newcommand{\LiaListOfFigures}{
  \setboolean{LiaListOfFiguresProvided}{true}
}
  
\renewcommand{\@maketitle}{
  \LiaFrontPages{}
  \newpage
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
      \newpage            % from article.cls
    % Prevents figures from going at top of page.    % from article.cls
      \global\@topnum\z@          % from article.cls
      \@maketitle            % from article.cls
    \fi                % from article.cls
    \LiaMarks            % new
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
    \LiaMarks        % new
  }              % \newpage from latex.ltx
}                % \maketitle from article.sty

\newcommand\listtbdname{List of To--Be--Determined}
\newcommand\listoftbd{%
  \section*{\listtbdname}%
    \@mkboth{\MakeUppercase\listtbdname}%
            {\MakeUppercase\listtbdname}%
  \@starttoc{lod}%
}

% head and foot lines
\newsavebox{\LiaHeadLogos}
\savebox{\LiaHeadLogos}{
\parbox[c]{1.3cm}{\includegraphics[width=1.3cm]{logo_lia_large_75}}%
}

\newcommand{\LiaMarks}{
  \fancyfoot{} % Clear all foot markings
  \fancyhead{} % Clear all head markings
  %\fancyheadoffset[L,RO]{1cm}
  %\fancyheadoffset{0.5cm} % Clear all head markings

  \pagestyle{fancy}
  \thispagestyle{fancy}

  \lhead{%
    \renewcommand{\arraystretch}{1}
    \setlength{\tabcolsep}{0pt}
    \begin{tabular}{p{97pt}p{314pt}p{63pt}}
    \raisebox{0.05cm}{\usebox{\LiaHeadLogos}}
    &
    \begin{tabular}{l}
    \usebox{\LiaHeaderTitle}
    \quad({\LiaFont{b}{10}{10pt}\sffamily v\LiaVersionVar}) \\
    {\LiaFont{m}{10}{10pt}{\sffamily\nouppercase{\leftmark}}}
    \end{tabular}
    &
    \hfill\begin{tabular}{p{63pt}}
    \multicolumn{1}{r}{\LiaFont{m}{10}{10pt}\sffamily Page} \\
    \multicolumn{1}{r}{%
      \LiaFont{m}{10}{10pt}\sffamily\thepage\ of \pageref{LastPage}%
    }
    \end{tabular}
    \end{tabular}%
  }
}

\newcommand{\LiaMarginDotBlue}{%
\leavevmode%
\marginnote{\hfill\raisebox{-3pt}{\color{LiaBlue}\Huge\textbullet}}%
}
\newcommand{\LiaMarginDotRed}{%
\leavevmode%
\marginnote{\hfill\raisebox{-3pt}{\color{LiaRed}\Huge\textbullet}}%
}
\newcommand{\LiaMarginDotGreen}{%
\leavevmode%
\marginnote{\hfill\raisebox{-3pt}{\color{LiaGreen}\Huge\textbullet}}%
}
\newcommand{\LiaMarginDot}{%
\leavevmode%
\marginnote{\hfill\raisebox{-3pt}{\Huge\textbullet}}%
}
\newcommand{\LiaMargin}[1]{%
\leavevmode\marginnote{\hfill\LiaFont{m}{10}{10pt}\sffamily#1}%
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
  pdfcreator={Latex with lia class},   % creator of the document
  pdffitwindow=true,      % page fit to window when opened
  pdfkeywords={}, % list of keywords
  pdfmenubar=true,        % show Acrobat’s menu?
  pdfnewwindow=true,      % links in new window
  pdfproducer={Arno Formella}, % producer of the document
  pdfsubject={lia document},   % subject of the document
  %pdftex,
  pdftitle={LIA Document},    % title
  pdftoolbar=true,        % show Acrobat’s toolbar?
  unicode=false,          % non-Latin characters in Acrobat’s bookmarks
  urlcolor=cyan           % color of external links
}

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

%\renewcommand\labelitemi{\normalfont\bfseries --}
%\renewcommand\labelitemii{$\m@th\bullet$}

