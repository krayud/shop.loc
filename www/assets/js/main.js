//set_cookie ( "username", "Вася Пупкин", 24, "","domain.com", "secure" ); +24 часа
function set_cookie( name, value, exp_days, path, domain, secure )
{
  var cookie_string = name + "=" + escape ( value );
 
  if ( exp_days )
  {
	date=new Date();
	newtime = date.getTime()+1000*60*60*24*exp_days;
	date = new Date(newtime);
    cookie_string += "; expires=" + date.toString();
  }
 
  if ( path )
        cookie_string += "; path=" + escape ( path );
 
  if ( domain )
        cookie_string += "; domain=" + escape ( domain );
  
  if ( secure )
        cookie_string += "; secure";
  
  document.cookie = cookie_string;
}

function delete_cookie(cookie_name)
{
  var cookie_date = new Date ( );  // Текущая дата и время
  cookie_date.setTime ( cookie_date.getTime() - 1 );
  document.cookie = cookie_name += "=; expires=" + cookie_date.toGMTString();
}