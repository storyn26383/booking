(function(){$(document).on("click","[data-method=DELETE]",function(e){return noty({theme:"relax",type:"confirm",layout:"center",modal:!0,text:"<h4>您真的要刪除嗎？</h4>",animation:{open:"animated bounceInDown",close:"animated bounceOutUp"},buttons:[{text:"返回",addClass:"btn btn-default",onClick:function(e){return e.close()}},{text:"刪除",addClass:"btn btn-danger",onClick:function(e){return function(n){var t;return t=$('meta[name="csrf-token"]').attr("content"),$('<form action="'+e.href+'" method="POST">').hide().append('<input type="hidden" name="_method" value="DELETE">').append('<input type="hidden" name="_token" value="'+t+'">').appendTo($("body")).submit()}}(this)}]}),e.preventDefault()}).on("click",".calendar .progress-bar-success",function(e){return $(".calendar .progress-bar-info").removeClass("progress-bar-info").addClass("progress-bar-success"),$(this).removeClass("progress-bar-success").addClass("progress-bar-info"),$(".selected-date").val($(this).data("date")),$(".next-step").removeClass("hide")}).on("change",".room-radio",function(e){return $(".next-step").removeClass("hide")})}).call(this);