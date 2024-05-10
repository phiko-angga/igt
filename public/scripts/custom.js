
function swithAutoRefresh(){
  let url = window.location.pathname;
  if(autoRefresh){
    fautoRefresh = setInterval(function(){
      if(url.indexOf("/rekapitulasi-hasil") > -1 || url.indexOf("/detail-data") > -1 || url.indexOf("/master-surveyor/") > -1){
        fetch_tabledata(url);
      }else{
        if ($.isFunction(window.getDashboardSummary)){
          getDashboardSummary();
        }
      }
    },5000);
  }else{
    // console.log('0');
    clearInterval(fautoRefresh);
  }
}

$('.print_pdf, .print_excel').click(function(e){
  let url = $(this).data('url');
  let search = $("#search").val();
  let provinsi = $("#provinsi_id").val();
  let kota = $("#kota_id").val();
  let kecamatan = $("#kecamatan_id").val();
  let kelurahan = $("#kelurahan_id").val();

  if(url.indexOf("/surveyor") > -1){
    let pelaporan_dpt = $("#pelaporan_dpt").val();
    let pelaporan_suara = $("#pelaporan_suara").val();
    link = url+"?search="+search+"&provinsi="+provinsi+"&kota="+kota+"&kecamatan="+kecamatan+"&kelurahan="+kelurahan+"&pelaporan_dpt="+pelaporan_dpt+"&pelaporan_suara="+pelaporan_suara;
  }else{
    link = url+"?search="+search+"&provinsi="+provinsi+"&kota="+kota+"&kecamatan="+kecamatan+"&kelurahan="+kelurahan;
  }

  window.open(link, '_blank');
})

$('#autorefresh').click(function(e){
  autoRefresh = $(this).is(":checked");
  swithAutoRefresh();
})

function fetch_tabledata(url) {
        
  let show_per_page = $("#show-per-page").val();
  let search = $("#search").val();

  let payload = {show_per_page:show_per_page,search:search};

  if(url.indexOf("/master-surveyor") > -1 ){
    let tipe = $("#tipe_surveyor").val();
    let trigger = $("#trigger_word").val();
    let trigger_sudah = $("#trigger_word_sudah").val();
    payload.tipe_surveyor = tipe;
    payload.trigger_word = trigger;
    payload.trigger_word_sudah = trigger_sudah;
  }
  
  let urlParams = new URLSearchParams(window.location.search);
  if(urlParams.has('page')){
    page = urlParams.get('page');
    payload.page = page;
  }

  let params = {};
  params.url = url;
  params.data = payload;
  params.result = function(data){
      $('.list-table tbody').html('');
      $('.list-table tbody').append(data);

      var selected = [];
      $('input.switch-show-hide').each(function() {
        if(!$(this).is(":checked")) selected.push($(this).val());
      });
      if(selected.length){
        $.each(selected,function(x,y){
          switchShowHideAct(y, 0);
        })
      }
  }
  ajaxCall(params);
}

function ajaxCall(params = null){
  let baseUrl = window.location.origin;
  let url = '';
  let type = 'get';
  let data = '';
  let result = function(response){
    // console.log(response);
  };

  if(params != null){
    if(typeof params.baseUrl != 'undefined') baseUrl = params.baseUrl;
    if(typeof params.url != 'undefined') url = params.url;
    if(typeof params.type != 'undefined') type = params.type;
    if(typeof params.data != 'undefined') data = params.data;
    if(typeof params.result != 'undefined') result = params.result;
  }

  $.ajax({
    url:baseUrl+url,
    type:type,
    data:data,
    success:result
  });
}

function getNewUrl(oldUrl = '', query) {
  var newUrl = oldUrl; 

  if(query.length > 0){
    $.each(query, function(index, val){

      if (oldUrl.match(val.key)) {
        
        var url = new URL(newUrl);
        url.searchParams.set(val.key, val.value); // setting your param
        newUrl = url.href;
      } else if (/\?/.test(newUrl)) {
        newUrl = newUrl +'&'+ val.key+"=" + val.value;
      } else {
        newUrl = newUrl + "?"+val.key+"=" + val.value;
      }
    })
    history.pushState('', '', newUrl);
  }
}  

function addCommas(nStr) {
  nStr += '';
  var x = nStr.split('.');
  var x1 = x[0];
  var x2 = x.length > 1 ? ',' + x[1] : '';
  var rgx = /(\d+)(\d{3})/;
  while (rgx.test(x1)) {
      x1 = x1.replace(rgx, '$1' + '.' + '$2');
  }
  return x1 + x2;
}

function formatDesign(item) {
    var selectionText = item.text.split("#");
    if(typeof selectionText[1] != 'undefined')
        var $returnString = $('<span>'+selectionText[0] + '</br><small>' + selectionText[1]  + '</small></span><hr style="margin-top: 0.2rem;margin-bottom: 0.2rem">');
    else
        var $returnString = selectionText;
    return $returnString;
  };
  
  function formatDesignSelected(item) {
    var selectionText = item.text.split("#");
    var $returnString = $('<span>'+selectionText[0] + (typeof selectionText[1] != 'undefined' ? ' | ' +selectionText[1] : '') + '</span>');
    return $returnString;
  };


  function templatePersentaseCapres(data){
    let template = '<div class="col-lg-4 col-md-12 col-sm-12 mb-4 pkandidat'+data.id+'">'+
                        '<h5>'+data.kandidat_nama+'</h5>'+
                        '<div id="growthChart'+data.id+'"></div>'+
                        '<div class="text-center fw-semibold pt-3 mb-2">'+
                            '<img style="margin-right: 12px;width:40px;height:40px;border-radius:5px" src="/images/'+data.image+'" alt="">'+
                            '<span class="suara_total">'+addCommas(data.suara_total)+' Total Suara</span> '+
                        '</div>'+
                    '</div>';
    return template;
  }

  $(document).on('click','.switch-show-hide',function(){
    let col = $(this).val();
    let show = $(this).is(':checked');
    switchShowHideAct(col,show);
  })

  function switchShowHideAct(col, show){

    let elHead = $("th[data-column='"+col+"']"); 
    let elBody = $("td[data-column='"+col+"']"); 
    
    if(show){
        elHead.removeClass('col-hide');
        elBody.removeClass('col-hide');
        elHead.addClass('col-show');
        elBody.addClass('col-show');
        $("#checkCol"+col).prop("checked",true);
    }else{
        elHead.addClass('col-hide');
        elBody.addClass('col-hide');
        elHead.removeClass('col-show');
        elBody.removeClass('col-show');
        $("#checkCol"+col).prop("checked",false);
    }
    // console.log($("#checkCol"+col));
  }

  function showNotification(param){
    let template = 
    '<div class="form-group mt-3">'+
        '<div class="alert alert-'+param.type+' alert-dismissible fade show" role="alert">'+
            '<strong>'+param.msg_strong+'!</strong> '+param.msg_desc+
            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'+
        '</div>'+
    '</div>';
    $(".show-notification").empty();
    $(".show-notification").append(template);
  }

  function showlampiran(param){
    if(param.lampiran.length){
      let template = '';
      $.each(param.lampiran, function(x,y){
        let surveyor = "";
        if(y.lampiran_url != null){
          if(y.jenis == 'perolehan_suara')
            surveyor = y.lampiran_url.substr(46,12);
          else
            surveyor = y.lampiran_url.substr(44,12);
        }
        template += 
          '<div style="width:30%;padding:7px"><figure class="figure p-2" style="width:100%;height:auto">'+
              '<a style="width: 100px;height:100px" target="_blank" href="'+y.lampiran_url+'"><img src="'+y.lampiran_url+'" class="figure-img img-fluid img-thumbnail rounded" alt="..."></a>'+
              '<figcaption class="figure-caption">'+(y.keterangan != null ? y.keterangan : '')+'</figcaption>'+
              '<figcaption class="figure-caption">'+"("+surveyor+") "+y.updated_date_at+" "+y.updated_time_at+'</figcaption>'+
          '</figure></div>';
      });
      $(param.element).empty();
      $(param.element).append(template);
    }
  }

  function showlampiran2(param){
    if(param.lampiran.length){
      let template = '';
      $.each(param.lampiran, function(x,y){
        let surveyor = "";
        if(y.lampiran_url != null){
          if(y.jenis == 'perolehan_suara')
            surveyor = y.lampiran_url.substr(46,12);
          else
            surveyor = y.lampiran_url.substr(44,12);
        }
        template += 
          '<div style="width:30%;padding:7px"><figure class="figure p-2" style="width:100%;height:auto">'+
              '<a style="width: 100px;height:100px" target="_blank" href="'+y.lampiran_url+'"><img src="'+y.lampiran_url+'" class="figure-img img-fluid img-thumbnail rounded" alt="..."></a>'+
              '<figcaption class="figure-caption">'+y.updated_date_at+" "+y.updated_time_at+'</figcaption>'+
          '</figure></div>';
      });
      $(param.element).empty();
      $(param.element).append(template);
    }
  }

  function showSuaraCaleg(data){
    if(data.data.length){
      let template = '';
      $.each(data.data, function(x,y){
        let ind = x+1;
        template += 
          '<tr>'+
            '<td>'+ind+'</td>'+
            '<td>'+y.nama+'</td>'+
            '<td>'+addCommas(y.suara_total)+'</td>'+
          '</tr>';
      });
      $(data.element).empty();
      $(data.element).append(template);
    }
  }

function getUrlVars(url)
{
    var vars = [], hash;
    var hashes = url.slice(url.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}

function getUrlSegment(url)
{
    var vars = [], hash;
    var hashes;
    if(url.indexOf('?') > -1)
      hashes = url.slice(0,url.indexOf('?')).split('/');
    else
      hashes = url.slice(0).split('/');

    return hashes;
}

function initSelect2(){
        
  if ( $('.select2advance').length > 0 ){
      $('.select2advance').each(function(index, el) {
          var limit_rows = 10;
          var url = $(this).data('select2-url');
          // var modal = $(this).data('select2-modal');
          var placeholder = $(this).data('select2-placeholder');
          // console.log('select2 ',modal);
          $(this).select2({
              placeholder: placeholder,
              width: 'resolve',
              // dropdownParent: $(modal+" .modal-content"),
              ajax: {
                  cache: true,
                  url: url,
                  dataType: 'json',
                  data: function (params) {
                      return {
                          q: params.term, // search term
                          page_limit: limit_rows,
                          page: params.page,
                      };
                  },
                  processResults: function (data, params) {
                  return {
                      results: data.items,
                      pagination: {
                          more: (params.page * limit_rows) < data.total           
                      }
                  };
                  },
                  cache: true
              }
          });
      })
  }
}

$(document).on('change','#municipio_id, #posto_id, #suco_id',function(e){
  let id = $(this).attr('id');
  if(id == 'municipio_id'){
      $("#posto_id").val("");
      $("#suco_id").val("");
      $("#aldeia_id").val("");
      $("#posto_id").data("select2-url",baseUrl+'/get-select/posto?municipio_id='+$("#municipio_id").val());
  }else
  if(id == 'posto_id'){
      $("#suco_id").val("");
      $("#aldeia_id").val("");
      $("#suco_id").data("select2-url",baseUrl+'/get-select/suco?posto_id='+$("#posto_id").val());
  }else
  if(id == 'suco_id'){
      $("#aldeia_id").val("");
      $("#aldeia_id").data("select2-url",baseUrl+'/get-select/aldeia?suco_id='+$("#suco_id").val());
  }
  initSelect2();
})
