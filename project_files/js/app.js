function Alert(mensaje,afterOk) //msgID: 1 Deprecated
{
	$.msg({
		autoUnblock : 	false,
		bgPath : 		baseURL+'project_files/css/',
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
		bgPath : 		baseURL+'project_files/css/',
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
		bgPath : 		baseURL+'project_files/css/',
        clickUnblock : 	false,
		content:		mensaje,
		msgID:			3
	});
}
function MensajeAfter(mensaje,afterOk) //msgID: 4
{
	$.msg({
		autoUnblock : 	false,
		bgPath : 		baseURL+'project_files/css/',
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

function fnCatalogo()
{
	this.FrmAdd=function()
	{
		var div=$("<div id='newData'>Ingrese los valores a agregar en el catálogo:</div>");
		for(var x=1;x<=10;x++)
		{
			div.append($('<br /><input type="text" name="valor[]" id="valor[]" maxlength="250" size="35" />'))
		}
		Confirm(div[0].outerHTML,function(){
			Catalogo.Add();
		});
	}
	this.Add=function()
	{
		var param=new Array();
		$("#newData input").each(function(){
			if(this.value.trim()!="")
                param.push(this.value.trim());
		});
        if(param.length==0) return false;
		$.post(baseURL+"catalogo/addoption/"+catname,{'valor[]':param},function(resp){
            if(resp.resultado) eval(resp.codigojs);
            else
            {
                if(resp.mensaje.tipo=="alert") Alert(resp.mensaje.texto,function(){eval(resp.codigojs);});
            }
        },'json')
        .fail(function(jqxhr,textStatus,error){
            if(jqxhr.status!=200)
            {
                var err="Error al almacenar los datos<br />Error "+jqxhr.status+": "+jqxhr.statusText;
                setTimeout(function(){Alert(err,function(){return true;});},500);
            }
            else setTimeout(function(){Alert(jqxhr.responseText,function(){return true;});},500);
        });
	}
	this.FrmDel=function()
	{
        var id=new Array();
        $("#tblelementos input").each(function(){
            if(this.checked)
                id.push(this.value);
        });
        if(id.length==0)
            Alert("Debe seleccionar al menos un elemento para eliminar",function(){return true;});
        else
		    Confirm("¿Realmente desea eliminar elo elementos seleccionados?",function(){Catalogo.Del();});
	}
	this.Del=function()
	{
		var id=new Array();
        $("#tblelementos input").each(function(){
            if(this.checked)
                id.push(this.value);
        });
        $.post(baseURL+"catalogo/deloption/"+catname,{'id[]':id},function(resp){
            if(resp.resultado) eval(resp.codigojs);
            else
            {
                if(resp.mensaje.tipo=="alert") Alert(resp.mensaje.texto,function(){eval(resp.codigojs);});
            }
        },'json')
        .fail(function(jqxhr,textStatus,error){
            if(jqxhr.status!=200)
            {
                var err="Error al eliminar los datos<br />Error "+jqxhr.status+": "+jqxhr.statusText;
                setTimeout(function(){Alert(err,function(){return true;});},500);
            }
            else setTimeout(function(){Alert(jqxhr.responseText,function(){return true;});},500);
        });
	}
	this.FrmUpd=function()
	{
		var div=$("<div id='newData'>Ingrese los nuevos valores:</div>");
        var elems=false;
        $("#tblelementos input").each(function(){
            if(this.checked)
            {
                var fila=$(this).parent().parent();
                var valor=fila.children()[1].innerHTML;
                div.append($('<br /><input type="text" name="valor[]" id="valor[]" maxlength="250" size="35" value="'+valor+'" />'))
                elems=true;
            }
        });
        if(!elems)
            Alert("Debe seleccionar al menos un elemento para actualizar.",function(){return true;})
        else
            Confirm(div[0].outerHTML,function(){Catalogo.Upd();});
	}
	this.Upd=function()
	{
		var param=new Array();
        var id=new Array();
        $("#newData input").each(function(){
            param.push(this.value.trim());
        });
        $("#tblelementos input").each(function(){
            if(this.checked)
                id.push(this.value);
        });
        $.post(baseURL+"catalogo/updoption/"+catname,{'valor[]':param,'id[]':id},function(resp){
            if(resp.resultado) eval(resp.codigojs);
            else
            {
                if(resp.mensaje.tipo=="alert") Alert(resp.mensaje.texto,function(){eval(resp.codigojs);});
            }
        },'json')
        .fail(function(jqxhr,textStatus,error){
            if(jqxhr.status!=200)
            {
                var err="Error al actualizar los datos<br />Error "+jqxhr.status+": "+jqxhr.statusText;
                setTimeout(function(){Alert(err,function(){return true;});},500);
            }
            else setTimeout(function(){Alert(jqxhr.responseText,function(){return true;});},500);
        });
	}
}

var auxFnPermiso=null;
function fnPermiso()
{
    this.CapturaNuevos=function()
    {
        auxFnPermiso=new Array();
        $("#elementosMenu input").each(function(){
            if(this.checked)
            {
                auxFnPermiso.push({
                    id:this.value,
                    per:$($(this).parent().parent().children()[0]).text(),
                    desc:$($(this).parent().parent().children()[1]).text()
                });
                this.checked=false;
            }
        });
        if(auxFnPermiso.length>0)
            this.FrmAdd(auxFnPermiso.shift());
        else
            Alert("Debe seleccionar un elemento para anidar los permisos.",function(){return true;});
    }
    this.FrmAdd=function(permiso)
    {
        var divFrmCont=$('<div></div>');
        divFrmCont.append($('<h3>'+permiso.per+'</h3>'));
        divFrmCont.append($('<div>'+permiso.desc+'</div>'));
        var frm=$('<form id="elementosMenuFrm"></form>');
        frm.append($('<input type="hidden" name="idpermiso" id="idpermiso" value="'+permiso.id+'" />'));
        var tbody=$('<tbody></tbody>');
        for(var x=1;x<=5;x++)
        {
            var p=$('<td><input type="text" name="elemento'+x+'" id="elemento'+x+'" value="" /></td>');
            var d=$('<td><input type="text" name="descripcion'+x+'" id="descripcion'+x+'" value="" /></td>');
            var tr=$('<tr></tr>');
            p.appendTo(tr);
            d.appendTo(tr);
            tr.appendTo(tbody);
        }
        frm.append($('<div class="table-responsive"><table class="table table-striped table-hover"><thead><tr><th>Nombre</th><th>Descripción</th></tr></thead><tbody>'+tbody.html()+'</tbody></table></div>'));
        divFrmCont.append(frm);
        Confirm(divFrmCont.html(),function(){Permiso.Add();});
    }
    this.Add=function()
    {
        $.post(baseURL+"permisos/add",$("#elementosMenuFrm").serialize(),function(resp){
            if(resp.resultado) eval(resp.codigojs);
            else
            {
                if(resp.mensaje.tipo=="alert") Alert(resp.mensaje.texto,function(){eval(resp.codigojs);});
            }
        },'json')
        .fail(function(jqxhr,textStatus,error){
            if(jqxhr.status!=200)
            {
                var err="Error al guardar los datos<br />Error "+jqxhr.status+": "+jqxhr.statusText;
                setTimeout(function(){Alert(err,function(){return true;});},500);
            }
            else setTimeout(function(){Alert(jqxhr.responseText,function(){return true;});},500);
        });
    }
    this.CapturaUpd=function()
    {
        auxFnPermiso=new Array();
        $("#elementosMenu input").each(function(){
            if(this.checked)
            {
                auxFnPermiso.push({
                    id:this.value,
                    per:$($(this).parent().parent().children()[0]).text(),
                    desc:$($(this).parent().parent().children()[1]).text()
                });
                this.checked=false;
            }
        });
        if(auxFnPermiso.length>0)
            this.FrmUpd(auxFnPermiso.shift());
        else
            Alert("Debe seleccionar un elemento para actualizar.",function(){return true;});
    }
    this.FrmUpd=function(permiso)
    {
        var divFrmCont=$('<div></div>');
        divFrmCont.append($('<h3>'+permiso.per+'</h3>'));
        divFrmCont.append($('<div>'+permiso.desc+'</div>'));
        var frm=$('<form id="elementosMenuFrm"></form>');
        frm.append($('<input type="hidden" name="idpermiso" id="idpermiso" value="'+permiso.id+'" />'));
        var tbody=$('<tbody></tbody>');
        var p=$('<td><input type="text" name="elemento" id="elemento" value="" /></td>');
        var d=$('<td><input type="text" name="descripcion" id="descripcion" value="" /></td>');
        var tr=$('<tr></tr>');
        p.appendTo(tr);
        d.appendTo(tr);
        tr.appendTo(tbody);
        frm.append($('<div class="table-responsive"><table class="table table-striped table-hover"><thead><tr><th>Nombre</th><th>Descripción</th></tr></thead><tbody>'+tbody.html()+'</tbody></table></div>'));
        divFrmCont.append(frm);
        Confirm(divFrmCont.html(),function(){Permiso.Upd();});
    }
    this.Upd=function()
    {
        $.post(baseURL+"permisos/upd",$("#elementosMenuFrm").serialize(),function(resp){
            if(resp.resultado) eval(resp.codigojs);
            else
            {
                if(resp.mensaje.tipo=="alert") setTimeout(function(){Alert(resp.mensaje.texto,function(){eval(resp.codigojs);});},500);
            }
        },'json')
        .fail(function(jqxhr,textStatus,error){
            if(jqxhr.status!=200)
            {
                var err="Error al guardar los datos<br />Error "+jqxhr.status+": "+jqxhr.statusText;
                setTimeout(function(){Alert(err,function(){return true;});},500);
            }
            else setTimeout(function(){Alert(jqxhr.responseText,function(){return true;});},500);
        });
    }
    this.FrmDel=function()
    {
        auxFnPermiso=new Array();
        $("#elementosMenu input").each(function(){
            if(this.checked)
            {
                auxFnPermiso.push(this.value);
                this.checked=false;
            }
        });
        if(auxFnPermiso.length>0)
            Confirm("¿Realmente desea eliminar los permisos seleccionados?",function(){Permiso.Del(auxFnPermiso.shift());});
        else
            Alert("Debe seleccionar un elemento para eliminar.",function(){return true;});
    }
    this.Del=function(permiso)
    {
        $.post(baseURL+"permisos/del",{idpermiso:permiso},function(resp){
            if(resp.resultado) eval(resp.codigojs);
            else
            {
                if(resp.mensaje.tipo=="alert") setTimeout(function(){Alert(resp.mensaje.texto,function(){eval(resp.codigojs);});},500);
            }
        },'json')
        .fail(function(jqxhr,textStatus,error){
            if(jqxhr.status!=200)
            {
                var err="Error al guardar los datos<br />Error "+jqxhr.status+": "+jqxhr.statusText;
                setTimeout(function(){Alert(err,function(){return true;});},500);
            }
            else setTimeout(function(){Alert(jqxhr.responseText,function(){return true;});},500);
        });
    }
}

function fnPerfil()
{
    this.ValidaFrmIn=function()
    {
        if(Validacion.Vacio('frm_perfil_nombre','Debe ingresar el nombre del perfil.'))
            return false;
        return true;
    }
    this.Enviar=function(nuevo)
    {
        if(this.ValidaFrmIn())
        {
            var urlFrm=baseURL+"perfiles/"+(nuevo===true?'add':'upd');
            Mensaje("Guardando datos");
            $.post(urlFrm,$("#frm_perfil").serialize(),function(resp){
                $.msg('unblock',10,3);
                if(resp.resultado) eval(resp.codigojs);
                else
                {
                    if(resp.mensaje.tipo=="alert") setTimeout(function(){Alert(resp.mensaje.texto,function(){eval(resp.codigojs);});},500);
                }
            },'json')
            .fail(function(jqxhr,textStatus,error){
                $.msg('unblock',10,3);
                if(jqxhr.status!=200)
                {
                    var err="Error al guardar los datos<br />Error "+jqxhr.status+": "+jqxhr.statusText;
                    setTimeout(function(){Alert(err,function(){return true;});},500);
                }
                else setTimeout(function(){Alert(jqxhr.responseText,function(){return true;});},500);
            });
        }
    }
    this.Eliminar=function(id)
    {
        Confirm("¿Realmente desea eliminar este perfil?",function(){
            var urlFrm=baseURL+"perfiles/del/"+id;
            $.post(urlFrm,{},function(resp){
                if(resp.resultado) eval(resp.codigojs);
                else
                {
                    if(resp.mensaje.tipo=="alert") setTimeout(function(){Alert(resp.mensaje.texto,function(){eval(resp.codigojs);});},500);
                }
            },'json')
            .fail(function(jqxhr,textStatus,error){
                if(jqxhr.status!=200)
                {
                    var err="Error al guardar los datos<br />Error "+jqxhr.status+": "+jqxhr.statusText;
                    setTimeout(function(){Alert(err,function(){return true;});},500);
                }
                else setTimeout(function(){Alert(jqxhr.responseText,function(){return true;});},500);
            });
        });
    }
}
function fnPersona()
{
    this.FrmAddTelefono=function()
    {
        var div=$('<div>Agregar Teléfono<br /></div>');
        var select=$('<select id="tipo"></select>');
        for(var x=0;x<tipotelefono.length;x++)
            select.append($('<option value="'+tipotelefono[x].idtipotelefono+'">'+tipotelefono[x].valor+'</option>'));
        div.append(select);
        div.append($('<span>&nbsp;</span>'))
        div.append($('<input type="tel" id="valor" />'));
        div.append($('<hr />'));
        Confirm(div.html(),function(){
            Persona.AddTelefono();
        });
    }
    this.FrmAddCorreo=function()
    {
        var div=$('<div>Agregar Correo<br /></div>');
        var select=$('<select id="tipo"></select>');
        for(var x=0;x<tipocorreo.length;x++)
            select.append($('<option value="'+tipocorreo[x].idtipocorreo+'">'+tipocorreo[x].valor+'</option>'));
        div.append(select);
        div.append($('<span>&nbsp;</span>'))
        div.append($('<input type="email" id="valor" />'));
        div.append($('<hr />'));
        Confirm(div.html(),function(){
            Persona.AddCorreo();
        });
    }
    this.AddTelefono=function()
    {
        var tbl=$("#persona_telefonos");
        var fila=$('<tr><td></td><td></td><td></td></tr>');
        fila.children()[0].innerHTML=$("#tipo")[0].options[$("#tipo")[0].selectedIndex].innerHTML;
        fila.children()[1].innerHTML=$("#valor").val();
        $(fila.children()[2]).append($('<button type="button" class="btn btn-default btn-xs pull-right" onclick="Persona.DelTelefono(this)"><span class="glyphicon glyphicon-remove"></span></button>'));
        $(fila.children()[2]).append($('<input type="hidden" name="frm_telefono_idtipotelefono[]" id="frm_telefono_idtipotelefono[]" value="'+$("#tipo").val()+'" />'));
        $(fila.children()[2]).append($('<input type="hidden" name="frm_telefono_valor[]" id="frm_telefono_valor[]" value="'+$("#valor").val()+'" />'));
        tbl.append(fila);
    }
    this.AddCorreo=function()
    {
        var tbl=$("#persona_correos");
        var fila=$('<tr><td></td><td></td><td></td></tr>');
        fila.children()[0].innerHTML=$("#tipo")[0].options[$("#tipo")[0].selectedIndex].innerHTML;
        fila.children()[1].innerHTML=$("#valor").val();
        $(fila.children()[2]).append($('<button type="button" class="btn btn-default btn-xs pull-right" onclick="Persona.DelCorreo(this)"><span class="glyphicon glyphicon-remove"></span></button>'));
        $(fila.children()[2]).append($('<input type="hidden" name="frm_correo_idtipocorreo[]" id="frm_correo_idtipocorreo[]" value="'+$("#tipo").val()+'" />'));
        $(fila.children()[2]).append($('<input type="hidden" name="frm_correo_valor[]" id="frm_correo_valor[]" value="'+$("#valor").val()+'" />'));
        tbl.append(fila);
    }
    this.DelTelefono=function(btn)
    {
        $(btn).parent().parent().remove();
    }
    this.DelCorreo=function(btn)
    {
        $(btn).parent().parent().remove();
    }
    this.ValidaFrmIn=function()
    {
        if(Validacion.Vacio('frm_persona_nombre','Debe ingresar el nombre.'))
            return false;
        if(Validacion.Vacio('frm_persona_apaterno','Debe ingresar el apellido paterno.'))
            return false;
        if(Validacion.Vacio('frm_persona_codigobarras','Debe ingresar el codigo de barras.'))
            return false;
        return true;
    }
    this.Enviar=function(nuevo)
    {
        if(this.ValidaFrmIn())
        {
            var urlFrm=baseURL+"personas/"+(nuevo===true?'add':'upd');
            Mensaje("Guardando datos");
            var form=new FormData($("#frm_persona")[0]);
            $.ajax({
                url:urlFrm,
                data:form,
                processData:false,
                contentType:false,
                dataType:'json',
                type:'POST'
            })
            .done(function(resp){
                $.msg('unblock',10,3);
                if(resp.resultado) eval(resp.codigojs);
                else
                {
                    if(resp.mensaje.tipo=="alert") setTimeout(function(){Alert(resp.mensaje.texto,function(){eval(resp.codigojs);});},500);
                }
            })
            .fail(function(jqxhr,textStatus,error){
                $.msg('unblock',10,3);
                if(jqxhr.status!=200)
                {
                    var err="Error al guardar los datos<br />Error "+jqxhr.status+": "+jqxhr.statusText;
                    setTimeout(function(){Alert(err,function(){return true;});},500);
                }
                else setTimeout(function(){Alert(jqxhr.responseText,function(){return true;});},500);
            });
        }
    }
    this.Eliminar=function(id)
    {
        Confirm("¿Realmente desea eliminar a esta persona?",function(){
            var urlFrm=baseURL+"personas/del/"+id;
            $.post(urlFrm,{},function(resp){
                if(resp.resultado) eval(resp.codigojs);
                else
                {
                    if(resp.mensaje.tipo=="alert") setTimeout(function(){Alert(resp.mensaje.texto,function(){eval(resp.codigojs);});},500);
                }
            },'json')
            .fail(function(jqxhr,textStatus,error){
                if(jqxhr.status!=200)
                {
                    var err="Error al guardar los datos<br />Error "+jqxhr.status+": "+jqxhr.statusText;
                    setTimeout(function(){Alert(err,function(){return true;});},500);
                }
                else setTimeout(function(){Alert(jqxhr.responseText,function(){return true;});},500);
            });
        });
    }
}

var Validacion  = new fnValidaciones();
var AppExec     = new fnAppExec();
var Catalogo    = new fnCatalogo();
var Permiso     =  new fnPermiso();
var Perfil      = new fnPerfil();
var Persona     = new fnPersona();