$( document ).ready(function() {	
	$(function() {
		 $(document).on('mouseenter', 'button[type="button"]', function(event) {		 	 
		 	 if((this.id).indexOf('nombre_')!=-1)
	    {
	    	var id="";
	    	 id = this.id.replace('nombre_','');
	    	Tabla(id);	    	
	    }		 	 
		 });
	});
});
function Tabla(id)
{	
		const template = document.querySelector('#template')
		const initialText = template.textContent
		const tip = tippy('.btn', {
		   theme: 'honeybee',
		  animation: 'shift-toward',
		  interactive: true,
		  arrow: true,
		  html: '#template',
		  trigger:'click',
		  position:'right',
		  onShow() {		   
		    const content = this.querySelector('.tippy-content')
		    if (tip.loading || content.innerHTML !== initialText) return		    
		    tip.loading = true		    
			var envio = { 
					"IDAL": id,					
				}; 
			
			var datos=JSON.stringify(envio)
		    $.post("../forms/horario.php",
		    	{jsonPHP: datos},
		    	function(data){
		    		if (data.R=="200") {
		    			tip.loading = false
		    			content.innerHTML = Html(data.DATOS);		    				    			
		    		}
		    		else
		    		{
		    			content.innerHTML = 'Loading failed'
		      			tip.loading = false
		    		}		    		
		    	}
		    	,'json');		   
		  },
		  onHidden() {
		    const content = this.querySelector('.tippy-content')
		    content.innerHTML = initialText
		  },		  
		  popperOptions: {
		    modifiers: {
		      preventOverflow: {
		        enabled: false
		      },
		      hide: {
		        enabled: false
		      },
		      
		    }
		  }
		})
	
}
function creartd (inicio,final)
{
	var Inicio = inicio.split(":");
	var Final = final.split(":");
	var Iniciohora=parseInt(Inicio[0]);
	var Iniciominutos=parseInt(Inicio[1]);
	var Finhoras=parseInt(Final[0]);
	var Finminutos=parseInt(Final[1]);	
	var Bandera=false;
	var Bandera2=true;
	var Html='';
	for (var i=7;i<24;i++)
	{		
		if(i==Iniciohora || (Bandera && i!=Finhoras)){
			if(Iniciominutos>0 && Bandera2)
			{
				Html+='<td style="background-color:rgba(25,189,200,.3);"></td>';
				Bandera2=false;
			}
			else{
				Html+='<td style="background-color:rgba(25,189,200,.9);"></td>';
			}
			Bandera=true;
		}
		else if(Bandera && i==Finhoras)
		{
			Bandera=false;
			Html+='<td style="background-color:rgba(25,189,200,.9);"></td>';
			if(Finminutos>0)
			{
				Html+='<td style="background-color:rgba(25,189,200,.3);"></td>';
			}
		}
		else
		{
			Bandera=false;
			Html+='<td></td>';
		}
	}
	return Html;
}
function Html(datos)
{	
	var vacio='<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>';
	 var Html='<div class="" style="aling-text:center center; text-decoration:none;"> Hora completa: <button class="btn" style="background-color:rgba(25,189,200,.9);"></button>    Hora incompleta: <button class="btn" style="background-color:rgba(25,189,200,.3);"></button></div>'+
		   			 ' <div class="">'+
					    '<table class="table">'+
					      '<thead>'+
					        '<tr>'+
					          '<th></th>'+
					           '<th>7:00</th>'+   
					       	  '<th>8:00</th>'+					                 
					          '<th>9:00</th>'+
					          '<th>10:00</th>'+
					          '<th>11:00</th>'+
					          '<th>12:00</th>'+
					          '<th>13:00</th>'+
					          '<th>14:00</th>'+
					          '<th>15:00</th>'+
					          '<th>16:00</th>'+
					          '<th>17:00</th>'+
					          '<th>18:00</th>'+
					          '<th>19:00</th>'+
					          '<th>20:00</th>'+
					          '<th>21:00</th>'+
					          '<th>22:00</th>'+
					          '<th>23:00</th>'+
					        '</tr>'+
					      '</thead>'+
					      '<tbody>'+
					       '<tr>';
			if(datos['e0']==null && datos['s0']==null ){Html+= '<td>Domingo</td>'+vacio;}else{Html+='<td>Domingo</td>'+creartd(datos['e0'],datos['s0']);}					     
		 			 Html+= '</tr>'+
					        '<tr>';
			if(datos['e1']==null && datos['s1']==null ){Html+='<td>Lunes</td>'+vacio;}else{Html+='<td>Lunes</td>'+creartd(datos['e1'],datos['s1']);}						          					                 
					  Html+='</tr>'+ 
					        '<tr>';
			if(datos['e2']==null && datos['s2']==null ){Html+='<td>Martes</td>'+vacio;}else{Html+='<td>Martes</td>'+creartd(datos['e2'],datos['s2']);}					          					                 
					  Html+='</tr>'+ 
					        '<tr>';
			if(datos['e3']==null && datos['s3']==null ){Html+='<td>Miercoles</td>'+vacio;}else{Html+='<td>Miercoles</td>'+creartd(datos['e3'],datos['s3']);}					          					                 
					   Html+='</tr>'+
					         '<tr>';
			if(datos['e4']==null && datos['s4']==null ){Html+='<td>Jueves</td>'+vacio;}else{Html+='<td>Jueves</td>'+creartd(datos['e4'],datos['s4']);}					          					                 
					   Html+='</tr>'+
					         '<tr>';
			if(datos['e5']==null && datos['s5']==null ){Html+='<td>Viernes</td>'+vacio;}else{Html+='<td>Viernes</td>'+creartd(datos['e5'],datos['s5']);}					          					                 
					   Html+='</tr>'+
					         '<tr>';
			if(datos['e6']==null && datos['s6']==null ){Html+='<td>Sabado</td>'+vacio;}else{Html+='<td>Sabado</td>'+creartd(datos['e6'],datos['s6']);}					          					                 
					   Html+='</tr>'+					                
					      '</tbody>'+
					    '</table>'+
					'</div>';
		return Html;
}



