program annamylove;
uses crt;
const n = 5;
var W:array [1..n] of string;
var Num:array [1..n] of real;

var i,j,word,number,minWordInd,maxWordInd,error:integer;
var translate,min:real;
var s,comp,numcomp:string;
var c:char;
var Letters: Set of 'A'..'Z';

begin

     clrscr;
     word := 1;
     number := 1;
     translate := 0;

      read(s);
      s:=s+' ';
      for i:=1 to length(s) do
       begin

          case s[i] of
          '0'..'9':
           begin
            numcomp:=numcomp+s[i];
           end;

          'a'..'z':
           begin
            comp:=comp+s[i];
           end;

           '-':
            begin
             if(length(numcomp)=0) then
              numcomp:=numcomp+'-';
            end;

           '.':
            begin
             if(length(numcomp)>0) then
              numcomp:=numcomp+'.';
            end;

           ' ':
            begin
            if(s[i+1]<>' ') then
             begin
              if(length(comp)>0) then
               begin
                W[word]:=comp;
                word:=word+1;
                comp:='';
               end
              else
               begin
                if(length(numcomp)>0) then
                 begin
                  val(numcomp,translate,error);
                  Num[number]:=translate;
                  number:=number+1;
                  numcomp:='';
                  translate:=0;
                 end;
               end;
             end;
            end;

          end;
       end;

     min:=Num[1];
     minWordInd := 1;
     for i:=1 to number-1 do
      if(Num[i] < min) then
       min:=Num[i];

     for i:=1 to word-1 do
      if(length(W[i]) < length(W[minWordInd])) then
       minWordInd:=i;

     maxWordInd:=1;
       
     for i:=1 to word-1 do
      if(length(W[i]) > length(W[maxWordInd])) then
       maxWordInd:=i;

     {for i:=1 to n do
         writeln(W[i]);
         
     for i:=1 to n do
      if(Num[i]<>0) then
          writeln(Num[i]);
          
     writeln('min = ', min);
     writeln('min word = ', W[minWordInd]);}


     for i:=1 to 20 do
      begin

           for j:=1 to word-1 do
            begin
               if(i<=length(W[j])) then
                write(W[j][i],'   ')
               else write('    ');
            end;

             writeln('');
      end;

end.
