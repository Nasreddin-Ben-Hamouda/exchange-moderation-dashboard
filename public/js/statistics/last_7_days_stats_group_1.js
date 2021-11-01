/*
  ce fichier contient toutes les intéractions utilisateur(evenement dom: clicks sur les boutons pour l'affichage en partie des métriques statistiques) 
  dans la page du tableau d bord (dashboard.blade.php)
  Ce fichier infoque des méthodes javascript contenus dans le fichier public/material/js/material-dashbaord.js
  a travers l'objet md,

  le fichier public/material/js/material-dashbaord.js est un fichier relative à la template utilisée
  et contient toutes les fonctions qui permettent de rempir et afficher les chartes graphiques par les données
  retournées apres l'appel AJAX a notre BACK-END
*/
const G1="g1";const G2="g2";const G3="g3";

//méthode qui execute un appel AJAX vers le BACK-END pour récupérer les statistiques contenus dans les 4 chartes bleus
function getLast7DaysStatsGroup1(offset=1,initLoad = true){
    $.ajax({
        url:$('meta[name="website-base-url"]').attr('content')+"/stats/get-last7days-stats-g1?offset="+offset,
        type:"GET",
        dataType: 'json',
        contentType: 'application/json; charset=utf-8',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(data) {
            prepareDataToLast7DaysStatsGroup1(data);
            if(initLoad){
              $("#group-1-stats-container").removeClass("blur-container");
              $("#show-group-1-stats-btn").hide();
            }else{
               calculateAndRenderPaginatorDateInterval(offset,G1);
               $("#paginator-spinner-stats-group-1").hide();
            }
        },
        error: function(err){
          $("#group1-stats-error-msg").html("une erreur est survenue, veuillez ressayer plus tard!");
          $("#group1-stats-error-msg").show();
          if(initLoad){
            $("#spinner-stats-group-1").hide();
          }else{
            $("#paginator-spinner-stats-group-1").hide();
          }
          console.log(err);
        }
  });
}


//méthode qui execute un appel AJAX vers le BACK-END pour récupérer les statistiques contenus dans les 2 dernières pie charts en jaune
function getPerDayStatsGroup2(offset=1,initLoad = true){
   $.ajax({
      url:$('meta[name="website-base-url"]').attr('content')+"/stats/get-last7days-per-day-stats-g2?offset="+offset,
      type:"GET",
      dataType: 'json',
      contentType: 'application/json; charset=utf-8',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      success: function(data) {
         prepareDataToLast7DaysStatsGroup2(data,true);
         if(initLoad){
            $("#group-2-perDay-stats-container").removeClass("blur-container");
            $("#show-perDay-group-2-stats-btn").hide();
         }else{
            calculateAndRenderPaginatorDateIntervalForPerDayPieCharts(offset);
            $("#perDay-paginator-spinner-stats-group-2").hide();
         }
      },
      error: function(err){
         $("#group2-perDay-stats-error-msg").html("une erreur est survenue, veuillez ressayer plus tard!");
         $("#group2-perDay-stats-error-msg").show();
         if(initLoad){
          $("#spinner-perDay-stats-group-2").hide();
         }else{
          $("#perDay-paginator-spinner-stats-group-2").hide();
         }
         console.log(err);
      }
  });    
}


//méthode qui execute un appel AJAX vers le BACK-END pour récupérer les statistiques contenus dans les 2 premieres pie charts en jaune
function getLast7DaysStatsGroup2(offset=1,initLoad = true){
    $.ajax({
        url:$('meta[name="website-base-url"]').attr('content')+"/stats/get-last7days-stats-g2?offset="+offset,
        type:"GET",
        dataType: 'json',
        contentType: 'application/json; charset=utf-8',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(data) {
           prepareDataToLast7DaysStatsGroup2(data);
           if(initLoad){
             $("#group-2-stats-container").removeClass("blur-container");
             $("#show-group-2-stats-btn").hide();
           }else{
              calculateAndRenderPaginatorDateInterval(offset,G2);
              $("#paginator-spinner-stats-group-2").hide();
           }
        },
        error: function(err){
           $("#group2-stats-error-msg").html("une erreur est survenue, veuillez ressayer plus tard!");
           $("#group2-stats-error-msg").show();
           if(initLoad){
            $("#spinner-stats-group-2").hide();
           }else{
            $("#paginator-spinner-stats-group-2").hide();
           }
           console.log(err);
        }
  });  
}


//méthode qui execute un appel AJAX vers le BACK-END pour récupérer les listes des 5 derniers :profils utilisateurs postes et commentaires signalés
function getLastSignaledPostsAndProfilesGroup3Stats(n){
      $.ajax({
        url:$('meta[name="website-base-url"]').attr('content')+"/stats/get-last-signaled-posts-and-profiles-stats-g3?n="+n,
        type:"GET",
        dataType: 'json',
        contentType: 'application/json; charset=utf-8',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(data) {
            prepareDataToLastSignaledPostsAndProfilesGroup3DataTables(data);
            $("#last-signaled-posts-and-profiles-container").removeClass("blur-container");
            $("#show-last-signaled-posts-profiles-btn").hide();
        },
        error: function(err){
            $("#spinner-signals").hide();
            $("#group3-stats-error-msg").html("une erreur est survenue, veuillez ressayer plus tard!");
            $("#group3-stats-error-msg").show();
            console.log(err);
        }
  });    
}

/*
  méthode qui se charge de formater le résultat retourné de l'appel/requete HTTP AJAX
  pour le rendre comptaible avec les élements de l'UI (les chartes graphiques)
*/
function prepareDataToLast7DaysStatsGroup1(data){
    var dataSignaledProfiles = {
        labels: Object.keys(data.SIGNALED_PROFILES).map(String).map(val=> moment(val, "YYYY-MM-DD").format("ddd")),
        series: [Object.values(data.SIGNALED_PROFILES).map(Number)]
    };
    var dataSignaledPosts = {
        labels: Object.keys(data.SIGNALED_POSTS).map(String).map(val=> moment(val, "YYYY-MM-DD").format("ddd")),
        series: [Object.values(data.SIGNALED_POSTS).map(Number)]
    };

    var dataSignaledComments = {
        labels: Object.keys(data.SIGNALED_COMMENTS).map(String).map(val=> moment(val, "YYYY-MM-DD").format("ddd")),
        series: [Object.values(data.SIGNALED_COMMENTS).map(Number)]
    };
    
    var dataTopPosts = {
        labels: Object.keys(data.POSTS_WEIGHTED_OVER_THAN_100).map(String).map(val=> moment(val, "YYYY-MM-DD").format("ddd")),
        series: [Object.values(data.POSTS_WEIGHTED_OVER_THAN_100).map(Number)]
    };
    md.initDashboardPageGroup1Charts(dataSignaledProfiles,dataSignaledPosts,dataSignaledComments,dataTopPosts);
}


/*
  méthode qui se charge de formater le résultat retourné de l'appel/requete HTTP AJAX
  pour le rendre compatible avec les élements de l'UI (les chartes graphiques)
*/
function prepareDataToLast7DaysStatsGroup2(data,isPerDayPieChars=false){
    var keys = Object.keys(data);
    var mapper ={
        "C_I1":"nbr de commentaires",
        "C_I2":"nbr de signals de postes",
        "C_I3":"nbr de signals de profils",
        "C_I4": "nbr de signals de commentaires",
        "C_I5":"nbr de postes",
        "C_I6":"nbr de topics",
        "C_I7":"nbr de votes poids",

        "C_P1":"nbr de publicataires des postes",
        "C_P2":"nbr de commentateurs",
        "C_P3":"nbr de signaleurs de postes",
        "C_P4":"nbr de signaleurs de commentaires",
        "C_P5":"nbr de signaleurs de profils",
        "C_P6":"nbr de créateurs de topics",
        "C_P7":"nbr de voteurs de poids"
    };
    
    var dataInteractions = {
        series: []
    };

    var dataContributors = {
        series: []
    };

    keys.forEach(element => {
      if(element.includes("I")){
        dataInteractions.series.push({meta:mapper[element],value:data[element]});
      }else if(element.includes("P")){
        dataContributors.series.push({meta:mapper[element],value:data[element]});
      }
    });

    md.initDashboardPageGroup2Charts(dataInteractions,dataContributors,isPerDayPieChars);
}


/*
  méthode qui se charge de formater le résultat retourné de l'appel/requete HTTP AJAX
  pour le rendre compatible avec les élements de l'UI (les chartes graphiques)
*/
function prepareDataToLastSignaledPostsAndProfilesGroup3DataTables(data){
   var postsDT=  $("#dt-posts");
   var profilesDT=  $("#dt-profiles");
   var commentsDT=  $("#dt-comments");
   postsDT.empty();
   profilesDT.empty();
   commentsDT.empty();

   if(Array.isArray(data)){
      var size = data.length;
      var oneThird = size / 3;

      for(var i=0;i<oneThird;i++){
        renderRowForPostsDT(postsDT,data[i]);
      }
      for(var i=oneThird;i<2*oneThird;i++){
        renderRowForProfilesDT(profilesDT,data[i]);
      }
      for(var i=2*oneThird;i<size;i++){
         renderRowForCommentsDT(commentsDT,data[i]);
      }
   }else{}
}


/*
  méthode qui se charge manipuler le DOM (création dynamique des element DOM pour afficher le résultat de la requete AJAX)
*/
function renderRowForPostsDT(domParent,data){
   var diff = moment().diff(moment(data['LAST_SIGNAL_AT'],'YYYY-MM-DD hh:mm:ss'),"days");
   var domElement = $("<tr/>").append(
      $("<td/>",{text:data['C1']})
   ).append(
      $("<td/>",{text:data['C2']})
   ).append(
      $("<td/>",{text:data['C3']})
   ).append(
      $("<td/>").append($("<a/>",{href:$('meta[name="website-base-url"]').attr('content')+"/profiles/"+data["C5"]+"/show",text:data['C4']+' ( ID = '+data['C5']+')',target:"_blank"}))
   ).append(
       diff == 0 ? 
         $("<td/>",{css:{color:"green"},text: "Aujourd'hui ("+data['LAST_SIGNAL_AT']+")"})
       :
         $("<td/>",{text:data['LAST_SIGNAL_AT']})

   ).append(
      $("<td/>",{text:data['NBR_OF_SIGNALS']})
   ).append(
      $("<td/>").append(
         $("<a/>",
            {
               href:$('meta[name="website-base-url"]').attr('content')+"/stats/post/"+data['C1']+"/signals",
               target:"_blank"
            }).append($("<i/>",{class:"material-icons",text:"visibility"}))
      )
   );
   //
   domParent.append(domElement);
}


/* 
   méthode qui se charge manipuler le DOM (création dynamique des element DOM pour afficher le résultat de la requete AJAX)
*/
function renderRowForProfilesDT(domParent,data){
   var diff = moment().diff(moment(data['LAST_SIGNAL_AT'],'YYYY-MM-DD hh:mm:ss'),"days");

   var domElement = $("<tr/>").append(
      $("<td/>",{text:data['C1']})
   ).append(
      $("<td/>",{text:data['C3']})
   ).append(
      $("<td/>",{text:data['C2']})
   ).append(
      $("<td/>",{text:data['C4']})
   ).append(
      $("<td/>",{text:data['C5']})
   ).append(
        diff == 0 ? 
         $("<td/>",{css:{color:"green"},text: "Aujourd'hui ("+data['LAST_SIGNAL_AT']+")"})
       :
         $("<td/>",{text:data['LAST_SIGNAL_AT']})
   ).append(
      $("<td/>",{text:data['NBR_OF_SIGNALS']})
   ).append(
      $("<td/>").append(
         $("<a/>",
            {
               href:$('meta[name="website-base-url"]').attr('content')+"/stats/blog-users/signals-contexts/"+data['C1']+"?fullname="+data["C3"]+" "+data["C2"],
               target:"_blank"
            }).append($("<i/>",{class:"material-icons",text:"visibility"}))
      )
   );
   domParent.append(domElement);  
}


 /* 
   méthode qui se charge manipuler le DOM (création dynamique des element DOM pour afficher le résultat de la requete AJAX)
*/
function renderRowForCommentsDT(domParent,data){
   var diff = moment().diff(moment(data['LAST_SIGNAL_AT'],'YYYY-MM-DD hh:mm:ss'),"days");
   var domElement = $("<tr/>").append(
      $("<td/>",{text:data['C1']})
   ).append(
      $("<td/>",{text:data['C2']})
   ).append(
      $("<td/>").append($("<a/>",{href:$('meta[name="website-base-url"]').attr('content')+"/posts/"+data["C3"]+"/show",text:"ID = "+data["C3"],target:"_blank"}))
   ).append(
      $("<td/>").append($("<a/>",{href:$('meta[name="website-base-url"]').attr('content')+"/profiles/"+data["C5"]+"/show",text:" l'utilisateur "+data["C5"]+"d'ID = "+data["C4"],target:"_blank"}))
   ).append(
      $("<td/>",{text:data['LAST_SIGNAL_AT']})
   ).append(
      $("<td/>",{text:data['NBR_OF_SIGNALS']})
   ).append(
      $("<td/>").append(
         $("<a/>",
            {
               href:$('meta[name="website-base-url"]').attr('content')+"/stats/comment/"+data['C1']+"/signals",
               target:"_blank"
            }).append($("<i/>",{class:"material-icons",text:"visibility"}))
      )
   );
   domParent.append(domElement);
}

/* 
   méthode utilitaire qui se charge de calculer une date et l'afficher sur l'UI (date sur laquelle les statiqtiques sont calculées) 
*/
function calculateAndRenderPaginatorDateInterval(coeff,statsGroup){
   var startDate = moment().subtract(6*coeff, "days").format("YYYY-MM-DD");
   var endDate = moment().subtract(6*(coeff- 1), "days").format("YYYY-MM-DD");
   $("#"+statsGroup+"-stats-chart1-footer").text("du "+startDate+" jusqu'a "+endDate);
   $("#"+statsGroup+"-stats-chart2-footer").text("du "+startDate+" jusqu'a "+endDate);
   if(statsGroup==G1){
     $("#g1-stats-chart3-footer").text("du "+startDate+" jusqu'a "+endDate);
     $("#g1-stats-chart4-footer").text("du "+startDate+" jusqu'a "+endDate);
   }
}

/* 
   méthode utilitaire qui se charge de calculer une date et l'afficher sur l'UI (date sur laquelle les statiqtiques sont calculées) 
*/
function calculateAndRenderPaginatorDateIntervalForPerDayPieCharts(coeff){
   var searchDate = moment().subtract(coeff - 1, "days").format("YYYY-MM-DD");
   $("#perDay-g2-stats-chart1-footer").text("dans le jour : "+searchDate );
   $("#perDay-g2-stats-chart2-footer").text("dans le jour : "+searchDate );
}

//code contenu dans cette fonction closure sera executé dés le chargement du document HTML se termine
$(function(){
  md.initDashboardPageCharts();
  var g1StatsPaginatorNbrClicks = 1;
  var g2StatsPaginatorNbrClicks = 1;
  var perDayG2StatsPaginatorNbrClicks = 1 ;

  $("#g1-paginator-previous-link").on("click",function(e){
     $("#paginator-spinner-stats-group-1").show();
     $("#group1-stats-error-msg").hide();

     g1StatsPaginatorNbrClicks++;
     getLast7DaysStatsGroup1(g1StatsPaginatorNbrClicks,false);

     if(g1StatsPaginatorNbrClicks == 2){
       $("#g1-paginator-next-link").removeClass("disabled");
       $("#g1-paginator-next-link").attr("aria-disabled",false);
     }
  });

  $("#g1-paginator-next-link").on("click",function(e){
     $("#group1-stats-error-msg").hide();

     var fetchData=true;
     if(g1StatsPaginatorNbrClicks==1){
       fetchData=false;
     }

     if(g1StatsPaginatorNbrClicks>=2){
        g1StatsPaginatorNbrClicks--;
     }
     if(g1StatsPaginatorNbrClicks==1){
      $(this).addClass("disabled");
      $(this).attr("aria-disabled",true);
     }

     if(fetchData){
       $("#paginator-spinner-stats-group-1").show();
       getLast7DaysStatsGroup1(g1StatsPaginatorNbrClicks,false);
     }
  });

   //GROUP 2 PIE CHARTS STATS
  $("#g2-paginator-previous-link").on("click",function(e){
    $("#paginator-spinner-stats-group-2").show();
    $("#group2-stats-error-msg").hide();

    g2StatsPaginatorNbrClicks++;
    getLast7DaysStatsGroup2(g2StatsPaginatorNbrClicks,false);

    if(g2StatsPaginatorNbrClicks == 2){
     $("#g2-paginator-next-link").removeClass("disabled");
     $("#g2-paginator-next-link").attr("aria-disabled",false);
    }
  });

  $("#g2-paginator-next-link").on("click",function(e){
    $("#group2-stats-error-msg").hide();

    var fetchData=true;
    if(g2StatsPaginatorNbrClicks==1) {
      fetchData=false;
    }

    if(g2StatsPaginatorNbrClicks>=2){
      g2StatsPaginatorNbrClicks--;
    }
    if(g2StatsPaginatorNbrClicks==1){
      $(this).addClass("disabled");
      $(this).attr("aria-disabled",true);
    }
    if(fetchData){
      $("#paginator-spinner-stats-group-2").show();
      getLast7DaysStatsGroup2(g2StatsPaginatorNbrClicks,false);
    }
  });

  $("#show-group-1-stats-btn").on("click",function(e){
     $("#group1-stats-error-msg").hide();
     $("#spinner-stats-group-1").show();
     var _this = this;
     getLast7DaysStatsGroup1();
  });

  $("#show-group-2-stats-btn").on("click",function(e){
     $("#group2-stats-error-msg").hide();
     $("#spinner-stats-group-2").show();
     var _this = this;
     getLast7DaysStatsGroup2();
  });

  //BEGIN WORK PIE CHARTS PER DAY
  $("#show-perDay-group-2-stats-btn").on("click",function(e){
    $("#group2-perDay-stats-error-msg").hide();
    $("#spinner-perDay-stats-group-2").show();
    var _this = this;
    getPerDayStatsGroup2();
  });

  //previous day
  $("#perDay-g2-paginator-previous-link").on("click",function(e){
   $("#perDay-paginator-spinner-stats-group-2").show();
   $("#group2-perDay-stats-error-msg").hide();

   perDayG2StatsPaginatorNbrClicks++;
   getPerDayStatsGroup2(perDayG2StatsPaginatorNbrClicks,false);

   if(perDayG2StatsPaginatorNbrClicks == 2){
    $("#perDay-g2-paginator-next-link").removeClass("disabled");
    $("#perDay-g2-paginator-next-link").attr("aria-disabled",false);
   }
   if(perDayG2StatsPaginatorNbrClicks > 7){
      $("#perWeek-g2-paginator-next-link").removeClass("disabled");
      $("#perWeek-g2-paginator-next-link").attr("aria-disabled",false);
   }
  });


 //next day
 $("#perDay-g2-paginator-next-link").on("click",function(e){
   $("#group2-perDay-stats-error-msg").hide();
   var fetchData=true;
   if(perDayG2StatsPaginatorNbrClicks==1){
     fetchData=false;
   }
  
   if(perDayG2StatsPaginatorNbrClicks>=2){
      perDayG2StatsPaginatorNbrClicks--;
   }
   if(perDayG2StatsPaginatorNbrClicks==1){
     $(this).addClass("disabled");
     $(this).attr("aria-disabled",true);
   }
   if(perDayG2StatsPaginatorNbrClicks<=7){
      $("#perWeek-g2-paginator-next-link").addClass("disabled");
      $("#perWeek-g2-paginator-next-link").attr("aria-disabled",true);
   }

   if(fetchData){
     $("#perDay-paginator-spinner-stats-group-2").show();
     getPerDayStatsGroup2(perDayG2StatsPaginatorNbrClicks,false);
   }
 });

 //previous week
 $("#perWeek-g2-paginator-previous-link").on("click",function(e){
   $("#perDay-paginator-spinner-stats-group-2").show();
   $("#group2-perDay-stats-error-msg").hide();

   $("#perDay-g2-paginator-next-link").removeClass("disabled");
   $("#perDay-g2-paginator-next-link").attr("aria-disabled",false);

   perDayG2StatsPaginatorNbrClicks+=7;
   getPerDayStatsGroup2(perDayG2StatsPaginatorNbrClicks,false);

   if(perDayG2StatsPaginatorNbrClicks >= 7){
    $("#perWeek-g2-paginator-next-link").removeClass("disabled");
    $("#perWeek-g2-paginator-next-link").attr("aria-disabled",false);
   }
  });

  //next week
  $("#perWeek-g2-paginator-next-link").on("click",function(e){
   $("#group2-perDay-stats-error-msg").hide();

   var fetchData=true;
   if(perDayG2StatsPaginatorNbrClicks<=7){
      fetchData=false;
   }
  
   if(perDayG2StatsPaginatorNbrClicks>7){
      perDayG2StatsPaginatorNbrClicks-=7;
   }
   if(perDayG2StatsPaginatorNbrClicks<=7){
     $(this).addClass("disabled");
     $(this).attr("aria-disabled",true);
   }
   if(perDayG2StatsPaginatorNbrClicks==1){
      $("#perDay-g2-paginator-next-link").addClass("disabled");
      $("#perDay-g2-paginator-next-link").attr("aria-disabled",true);
   }
   if(fetchData){
     $("#perDay-paginator-spinner-stats-group-2").show();
     getPerDayStatsGroup2(perDayG2StatsPaginatorNbrClicks,false);
   }
  });  
//END WORK PIE CHARTS PER DAY

  $("#show-last-signaled-posts-profiles-btn").on("click",function(e){
     $("#group3-stats-error-msg").hide();
     $("#spinner-signals").show();
     var _this = this;
     getLastSignaledPostsAndProfilesGroup3Stats(5);
  });
 });