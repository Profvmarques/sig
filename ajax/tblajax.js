$(document).ready(function()
{
    alert("carregou");

$(".edit_tr").click(function()
{
    alert("foi");

var ID=$(this).attr('id');
var string='nomeimg'+(ID+ID);
var nomeimg=$(this).attr(string);
$("#zero_"+ID).hide();
$("#primeiro_"+ID).hide();
$("#segundo_"+ID).hide();
$("#terceiro_"+ID).hide();

$("#zero_input"+ID).show();
$("#primeiro_input"+ID).show();
$("#segundo_input"+ID).show();
$("#terceiro_input"+ID).show();
//$("#button"+ID).show();
}).change(function()
{
var ID=$(this).attr('id');
var zero=$("#zero_input"+ID).val();
var primeiro=$("#primeiro_input"+ID).val();
var segundo=$("#segundo_input"+ID).val();
var terceiro=$("#terceiro_input"+ID).val();

var dataString = 'id='+ ID +'&zero='+zero+'&primeiro='+primeiro+'&segundo='+segundo+'&terceiro='+terceiro;
$("#primeiro_"+ID).html('<img src="img/load.gif" />');


if(primeiro.length >0 && segundo.length>0 && terceiro.length>0)
{
$.ajax({
type: "POST",
url: "../ajax/table_edit_ajax.php?nomeimg="+nomeimg,
data: dataString,
cache: false,
success: function(html)
{

$("#zero_"+ID).html(zero);
$("#primeiro_"+ID).html(primeiro);
$("#segundo_"+ID).html(segundo);
$("#terceiro_"+ID).html(terceiro);
//$("#button"+ID).html(button);
}
});
}
else
{
alert('Enter something.');
}

});

$(".editbox").mouseup(function() 
{
return false
});

$(document).mouseup(function()
{
$(".editbox").hide();
$(".text").show();
$(".button").show();
});

//-----------------------------FD------------------------------------

$(".edit_FD").click(function()
{
var ID=$(this).attr('id');
$("#primeiroFD_"+ID).hide();
$("#segundoFD_"+ID).hide();
$("#terceiroFD_"+ID).hide();
$("#primeiroFD_input"+ID).show();
$("#segundoFD_input"+ID).show();
$("#terceiroFD_input"+ID).show();

}).change(function()
{
var ID=$(this).attr('id');
var primeiro=$("#primeiroFD_input"+ID).val();
var segundo=$("#segundoFD_input"+ID).val();
var terceiro=$("#terceiroFD_input"+ID).val();


var dataString = 'id='+ ID +'&primeiro='+primeiro+'&segundo='+segundo+'&terceiro='+terceiro;
$("#primeiroFD_"+ID).html('<img src="img/load.gif" />');


if(primeiro.length && segundo.length>0 && terceiro.length>0)
{
$.ajax({
type: "POST",
url: "../ajax/table_edit_ajax_funcDomesticos.php",
data: dataString,
cache: false,
success: function(html)
{

$("#primeiroFD_"+ID).html(primeiro);
$("#segundoFD_"+ID).html(segundo);
$("#terceiroFD_"+ID).html(terceiro);

}
});
}
else
{
alert('Entre com algum dado.');
}

});

$(".editbox").mouseup(function() 
{
return false
});

$(document).mouseup(function()
{
$(".editbox").hide();
$(".text").show();

});

//---------------------------------Visitantes------------------------------------

$(".edit_visitante").click(function()
{
var ID=$(this).attr('id');
$("#primeiroV_"+ID).hide();
$("#segundoV_"+ID).hide();
$("#terceiroV_"+ID).hide();
$("#primeiroV_input"+ID).show();
$("#segundoV_input"+ID).show();
$("#terceiroV_input"+ID).show();

}).change(function()
{
var ID=$(this).attr('id');
var primeiro=$("#primeiroV_input"+ID).val();
var segundo=$("#segundoV_input"+ID).val();
var terceiro=$("#terceiroV_input"+ID).val();


var dataString = 'id='+ ID +'&primeiro='+primeiro+'&segundo='+segundo+'&terceiro='+terceiro;
$("#primeiroV_"+ID).html('<img src="img/load.gif" />');


if(primeiro.length && segundo.length>0 && terceiro.length>0)
{
$.ajax({
type: "POST",
url: "../ajax/table_edit_ajax_visitantes.php",
data: dataString,
cache: false,
success: function(html)
{

$("#primeiroV_"+ID).html(primeiro);
$("#segundoV_"+ID).html(segundo);
$("#terceiroV_"+ID).html(terceiro);

}
});
}
else
{
alert('Entre com algum dado.');
}

});

$(".editbox").mouseup(function() 
{
return false
});

$(document).mouseup(function()
{
$(".editbox").hide();
$(".text").show();

});

//---------------------------------Veículos------------------------------------

$(".edit_veiculo").click(function()
{
var ID=$(this).attr('id');
$("#primeiroVeic_"+ID).hide();
$("#segundoVeic_"+ID).hide();
$("#terceiroVeic_"+ID).hide();
$("#quartoVeic_"+ID).hide();
$("#quintoVeic_"+ID).hide();

$("#primeiroVeic_input"+ID).show();
$("#segundoVeic_input"+ID).show();
$("#terceiroVeic_input"+ID).show();
$("#quartoVeic_input"+ID).show();
$("#quintoVeic_input"+ID).show();

}).change(function()
{
var ID=$(this).attr('id');
var primeiro=$("#primeiroVeic_input"+ID).val();
var segundo=$("#segundoVeic_input"+ID).val();
var terceiro=$("#terceiroVeic_input"+ID).val();
var quarto=$("#quartoVeic_input"+ID).val();
var quinto=$("#quintoVeic_input"+ID).val();


var dataString = 'id='+ ID +'&primeiro='+primeiro+'&segundo='+segundo+'&terceiro='+terceiro+'&quarto='+quarto+'&quinto='+quinto;
$("#primeiroVeic_"+ID).html('<img src="img/load.gif" />');


if(primeiro.length && segundo.length>0 && terceiro.length>0 && quarto.length>0 && quinto.length>0)
{
$.ajax({
type: "POST",
url: "../ajax/table_edit_ajax_veiculos.php",
data: dataString,
cache: false,
success: function(html)
{

$("#primeiroVeic_"+ID).html(primeiro);
$("#segundoVeic_"+ID).html(segundo);
$("#terceiroVeic_"+ID).html(terceiro);
$("#quartoVeic_"+ID).html(quarto);
$("#quintoVeic_"+ID).html(quinto);

}
});
}
else
{
alert('Entre com algum dado.');
}

});

$(".editbox").mouseup(function() 
{
return false
});

$(document).mouseup(function()
{
$(".editbox").hide();
$(".text").show();

});

//---------------------------------Animais------------------------------------

$(".edit_animais").click(function()
{
var ID=$(this).attr('id');
$("#primeiroA_"+ID).hide();
$("#segundoA_"+ID).hide();
$("#terceiroA_"+ID).hide();
$("#primeiroA_input"+ID).show();
$("#segundoA_input"+ID).show();
$("#terceiroA_input"+ID).show();

}).change(function()
{
var ID=$(this).attr('id');
var primeiro=$("#primeiroA_input"+ID).val();
var segundo=$("#segundoA_input"+ID).val();
var terceiro=$("#terceiroA_input"+ID).val();


var dataString = 'id='+ ID +'&primeiro='+primeiro+'&segundo='+segundo+'&terceiro='+terceiro;
$("#primeiroA_"+ID).html('<img src="img/load.gif" />');


if(primeiro.length && segundo.length>0 && terceiro.length>0)
{
$.ajax({
type: "POST",
url: "../ajax/table_edit_ajax_animais.php",
data: dataString,
cache: false,
success: function(html)
{

$("#primeiroA_"+ID).html(primeiro);
$("#segundoA_"+ID).html(segundo);
$("#terceiroA_"+ID).html(terceiro);

}
});
}
else
{
alert('Entre com algum dado.');
}

});

$(".editbox").mouseup(function() 
{
return false
});

$(document).mouseup(function()
{
$(".editbox").hide();
$(".text").show();

});

});