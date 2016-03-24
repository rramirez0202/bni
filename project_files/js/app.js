function Alert(mensaje,afterOk) //msgID: 1 Deprecated
{
	$.msg({
		autoUnblock : 	false,
		bgPath : 		baseURL+'project_files/msg/',
        clickUnblock : 	false,
		content:		'<div>'+mensaje+'</div><div style="text-align: center;"><button id="btnOk" class="btn btn-success">Aceptar</button></div>',
		afterBlock:		function(){
							var self=this;
							$('#btnOk').bind('click',function(){
								self.unblock(300);
								afterOk();
							});
		                }
		//, msgID:1
	});
}
function Confirm(mensaje,afterOk) //msgID: 2 Deprecated
{
	$.msg({
		autoUnblock : 	false,
		bgPath : 		baseURL+'project_files/msg/',
        clickUnblock : 	false,
		content:		'<div>'+mensaje+'</div><div style="text-align: center;"><button id="btnOk" class="btn btn-success">Aceptar</button> <button id="btnCancel" class="btn btn-danger">Cancelar</button></div>',
		afterBlock : 	function(){
							var self=this;
							$('#btnOk').bind('click',function(){
								self.unblock(300);
								afterOk();
							});
							$('#btnCancel').bind('click',function(){
								self.unblock(300);
							});
		                }
		//, msgID:2
	});
}
function Mensaje(mensaje) //msgID: 3
{
	$.msg({
		autoUnblock : 	false,
		bgPath : 		baseURL+'project_files/msg/',
        clickUnblock : 	false,
		content:		mensaje,
		msgID:			3
	});
}
function MensajeAfter(mensaje,afterOk) //msgID: 4
{
	$.msg({
		autoUnblock : 	false,
		bgPath : 		baseURL+'project_files/msg/',
        clickUnblock : 	false,
		content:		mensaje,
		afterBlock:		function(){
							var self=this;
							afterOk();
						},
		msgID:			4
	});
}
function MuestraCPFrm(cp,colonia,municipio,estado,fnSelecciona)
{
	var datos="cp="+cp+"&colonia="+colonia+"&municipio="+municipio+"&estado="+estado+"&fnSelecciona="+fnSelecciona;
	Mensaje("Cargando Códigos Postales");
	var ajx=$.ajax({
		method:	"POST",
		url:	baseURL+'generico/creaFrmCP',
		cache:	false,
		data:	datos
	});
	ajx.fail(function(jqXHRObj,mensaje){
		$.msg('unblock',10,3);
		setTimeout(function(){
			Mensaje("Error al cargar formulario: "+mensaje+"<br />"+jqXHRObj.responseText);
		},500);
	});
	ajx.done(function(resp){
		$.msg('unblock',10,3);
		setTimeout(function(){
			MensajeAfter(resp,function(){
				$("#btnCancelarCP").bind('click',function(){
					$.msg('unblock',10,3);
				});
				$("#btnBuscarCP").bind('click',function(){
					var tmpCp			= $("#frm_cp_cp").val().trim();
					var tmpColonia		= $("#frm_cp_colonia").val().trim();
					var tmpMunicipio	= $("#frm_cp_municipio").val().trim();
					var tmpEstado		= $("#frm_cp_estado").val().trim();
					$.msg('unblock',10,4);
					setTimeout(function(){
						MuestraCPFrm(tmpCp,tmpColonia,tmpMunicipio,tmpEstado,fnSelecciona);
					},500);
				});
			});
		},500);
	});
}
function CrearZonaDrag(zona,claseCSSMove,fnCargaArchivos)
{
    zona.addEventListener('dragenter',function(e){
        e.preventDefault();
        $(zona).addClass(claseCSSMove);
    },false);
    zona.addEventListener('dragover',function(e){
        e.preventDefault();
    },false);
    zona.addEventListener('dragleave',function(e){
        e.preventDefault();
        $(zona).removeClass(claseCSSMove);
    },false);
    zona.addEventListener('drop',fnCargaArchivos,false);
}
function fnValidaciones()
{
	this.Vacio=function(idCampo,mensaje)
	{
		var valor	= "";
		valor		= $("#"+idCampo).val();
		valor		= (valor==null?'':valor.trim());
		if(valor.length==0) 
		{
			Alert(mensaje,function(){$("#"+idCampo).focus();});
			return true;
		}
		return false;
	}
	this.Numerico=function(idCampo,mensaje)
	{
		var valor	= "";
		valor		= $("#"+idCampo).val();
		valor		= (valor==null?'':valor.trim());
		if(this.Vacio(idCampo,mensaje))
			return false;
		if(isNaN(valor))
		{
			Alert(mensaje,function(){$("#"+idCampo).focus();});
			return false;
		}
		return true;
	}
	this.NPositivo=function(idCampo,mensaje,IncluyeCero)
	{
		if(this.Numerico(idCampo,mensaje))
		{
			var valor	= "";
			valor		= parseInt($("#"+idCampo).val().trim());
			if(IncluyeCero)
			{
				if(valor>=0) return true;
				else Alert(mensaje,function(){$("#"+idCampo).focus();});
			}
			else
				if(valor>0) return true;
				else Alert(mensaje,function(){$("#"+idCampo).focus();});
		}
		return false;
	}
	this.LargoEntre=function(idCampo,mensaje,minimo,maximo,puedeSerVacio)
	{
		var valor	= "";
		valor		= $("#"+idCampo).val();
		valor		= (valor==null?'':valor.trim());
		if(!puedeSerVacio && this.Vacio(idCampo,mensaje))
			return false;
		if(puedeSerVacio && valor.length==0)
			return true;
		if(valor.length<minimo||valor.length>maximo)
		{
			Alert(mensaje,function(){$("#"+idCampo).focus();});
			return false;
		}
		return true;
	}
	this.LargoCampo=function(idCampo)
	{
		var valor	= "";
		valor		= $("#"+idCampo).val();
		valor		= (valor==null?'':valor.trim());
		return valor.length;
	}
	this.Valor=function(idCampo)
	{
		var valor	= "";
		valor		= $("#"+idCampo).val();
		valor		= (valor==null?'':valor.trim());
		return valor;
	}
	this.CreaDireccion=function(idCampoCalle, idCampoNumExterior, idCampoNumInterior, idCampoColonia,idCampoDelegacion,idCampoEstado)
	{
		var calle		= this.Valor(idCampoCalle);
		var numExterior	= this.Valor(idCampoNumExterior);
		var numInterior	= this.Valor(idCampoNumInterior);
		var colonia		= this.Valor(idCampoColonia);
		var delegacion	= idCampoDelegacion!=""?this.Valor(idCampoDelegacion):"";
		var estado		= idCampoEstado!=""?this.Valor(idCampoEstado):"";
		var direccion	= "";
		direccion += calle + " ";
		direccion += numExterior;
		if(numInterior!="")
			direccion += " (Int. " + numInterior + "), ";
		else
			direccion += ", ";
		direccion += colonia;
		if(delegacion!="")
			direccion += ", "+delegacion;
		if(estado!="")
			direccion += ", "+estado
		return direccion;
	}
}

Date.prototype.getDiaSemana=function()
{
	var dias=new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
	return dias[this.getDay()];
}
Date.prototype.getMes=function()
{
	var meses=new Array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	return meses[this.getMonth()];
}
Date.prototype.agregaDias=function(numDias)
{
	this.setTime(this.getTime()+numDias*24*60*60*1000)
	return this;
}
Date.prototype.getSemana=function(anioAnterior)
{
	var diaPrimero=new Date(this.getFullYear()-(anioAnterior?1:0),0,1);
	var diasTranscurridos=Math.floor((this.getTime()-diaPrimero.getTime())/(1*24*60*60*1000));
	var nen=[6,7,8,9,10,4,5][diaPrimero.getDay()];
	var sem=Math.floor((diasTranscurridos+nen)/7);
	if(sem==0)
		return this.getSemana(true);
	return sem;
}
Date.prototype.getSemanaEnMes=function()
{
	var diaPrimero=new Date(this.getFullYear(),this.getMonth(),1);
	/*while(diaPrimero.getDay()!=1) // Es uno xq la semana inicia en lunes
	{
		diaPrimero.agregaDias(1);
	}*/
	//var numSemana=this.getSemana(false)-diaPrimero.getSemana(false)+(diaPrimero.getDay()==0?0:1);
	var numSemana=this.getSemana(false)-diaPrimero.getSemana(false)+1;
	if(numSemana>0)
		return numSemana;
	return this.getSemana(false)+(diaPrimero.getDay()==0?0:1);
}
Date.prototype.getUltimoDiaEnMesPrevio=function()
{
	var fecha=new Date(this.getFullYear(),this.getMonth(),1);
	fecha.agregaDias(-1);
	return fecha;
}
Array.prototype.igual=function(data)
{
	var cont=0;
	for(var x in this) 
		if(!isNaN(x) && typeof data[x]!="undefined" && this[x]==data[x])
			cont++;
	return (this.length==data.length && cont==this.length);
}
String.prototype.toNormalString=function()
{
	var cadena=this;
	var res="";
	for(var x=0;x<cadena.length;x++)
	{
		var car=cadena.substring(x,x+1);
		if(('a'<=car && car<='z')||('A'<=car && car<='Z')||('0'<=car && car<='9'))
			res+=car;
		else if(car=="á") res+="a";
		else if(car=="Á") res+="A";
		else if(car=="é") res+="e";
		else if(car=="É") res+="E";
		else if(car=="í") res+="i";
		else if(car=="Í") res+="I";
		else if(car=="ó") res+="o";
		else if(car=="Ó") res+="O";
		else if(car=="ú") res+="u";
		else if(car=="Ú") res+="U";
		else if(car=="ü") res+="u";
		else if(car=="Ü") res+="U";
		else res+=" ";
	}
	while(res.indexOf("  ")>=0)
		res=res.replace("  "," ");
	return res;
}
Number.prototype.truncar=function(decimales)
{
    var s=this.toString();
    s+=s.indexOf('.')==-1?".":"";
    s=s.substring(0,s.indexOf('.')+decimales+1);
    while(s.length<s.indexOf('.')+decimales+1)
        s+='0';
    return parseFloat(s);
}
Number.prototype.asInformaticSize=function()
{
    if(this<1024) return this.truncar(2)+" bytes";
    if(this<1024*1024) return (this/(1024)).truncar(2)+" KB";
    if(this<1024*1024*1024) return (this/(1024*1024)).truncar(2)+" MB";
    if(this<1024*1024*1024*1024) return (this/(1024*1024*1024)).truncar(2)+" GB";
    return (this/(1024*1024*1024*1024)).truncar(2)+" GB";
}

$.extend(true, $.fn.dataTable.defaults, {
	"scrollY": 400,
	"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todo"]],
	"language": {
	    "lengthMenu":	"Mostrar _MENU_ registros por página",
	    "zeroRecords":	"No se encontraron resultados",
	    "info":			"Página _PAGE_ de _PAGES_",
	    "infoEmpty":	"No hay resultados que mostrar",
	    "infoFiltered":	"(filtro de _MAX_ registros en total)",
	    "emptyTable":	"No hay resultados que mostrar",
	    "search":		"Buscar:",
	    "paginate": {
			"first":    "<span class=\"glyphicon glyphicon-fast-backward\"></span>",
			"previous": "<span class=\"glyphicon glyphicon-backward\"></span>",
			"next":     "<span class=\"glyphicon glyphicon-forward\"></span>",
			"last":     "<span class=\"glyphicon glyphicon-fast-forward\"></span>"
		},
		"decimal": ".",
        "thousands": ","
	},
	"searching": false,
	"pagingType": "full_numbers",
	"order": [[ 0, "asc" ]]
});
function estandarizaTamanio()
{
    if($("#pageSuperBodyContainer").length>0 && $("#pageFooter").length>0)
    {
        var altoPageGlobalHeader=$("#pageGlobalHeader").length>0?$("#pageGlobalHeader").height():0;
        var altoPageFooter=$("#pageFooter").length>0?$("#pageFooter").height():0;
        var altoPageSuperBodyContainer=$("#pageSuperBodyContainer").height();
        $("#pageSuperBodyContainer").css('top',altoPageGlobalHeader);
        if(altoPageGlobalHeader+altoPageFooter+altoPageSuperBodyContainer<=$(window).height())
            $("#pageFooter").css('bottom','1px');
        else
            $("#pageFooter").css('top',parseInt($("#pageSuperBodyContainer").css('top').replace("px",""))+altoPageSuperBodyContainer+"px");
    }
}

function fnAppExec()
{
    this.ButtonPanelToggle=function(btnPadre)
    {
        $(btnPadre.getElementsByTagName('span')[0]).toggle();
        $(btnPadre.getElementsByTagName('span')[1]).toggle();
    }
}

var AppExec = new fnAppExec();