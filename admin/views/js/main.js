$(document).ready(function() {
    
    
    /*--------------------------------------*/
    /*----------------Toasts----------------*/
    /*--------------------------------------*/
    
    $('.largetoast').each(function() {

        $(this).delay(20).animate({opacity: 1, bottom: "30px"}, 45).delay(3000).animate({opacity: 0, bottom: "45px"}, 45).delay(150).hide(0);
    });
    
    /*--------------------------------------*/
    /*----------Champs de recherche---------*/
    /*--------------------------------------*/
    
    $('input.recherche').keyup(function() {
        var texteSaisis = $(this).val().toLowerCase();

        $(this).siblings('table').find('tbody').find('tr').each(function() {
            console.log('ok');
           var chaine = $(this).html().toLowerCase();
            if(chaine.indexOf(texteSaisis) != -1) {
                $(this).show();   
            } else {
                $(this).hide();   
            }
        });
    });
    
    /*--------------------------------------*/
    /*--------Activation des tooltips-------*/
    /*---------et popovers bootstrap--------*/
    /*--------------------------------------*/
    
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
    
    $('.suppression-popover, .suppression-fichier-popover, .suppression-data-popover').popover({ 
        html : true,
        trigger : 'click',
        title: function() {
            return 'Toute suppression est définitive';
        },
        content: function() {
            return $("#popover-suppression-content").html();
        }
    });
    
    /*--------------------------------------*/
    /*-------Boutons dans les listes--------*/
    /*--------------------------------------*/
    
    $(document).on('mouseover', 'tr', function(){
        $(this).toggleClass('control-section-hover');
        $(this).parent('tbody').find('tr .control-section').not('.control-section-hover').each(function() {
           $(this).hide(); 
        });
        $(this).find('.control-section').toggle(); 
    });


    /*--------------------------------------*/
    /*---Recherche, pagination des tables---*/
    /*--------------------------------------*/

    $(function() {
        $('.datatable').DataTable({
            "language": {
                "url": "views/js/datatables/datatables-french.json",
                search: "_INPUT_",
                searchPlaceholder: "Rechercher..."
            },
            "order": [[ 6, "desc" ]]
            
        });
        
    });

    /*--------------------------------------*/
    /*------Listes des fichiers triable-----*/
    /*--------------------------------------*/

    $(function() {
        $('.sortable').sortable().bind('sortupdate', function() {
    
        var tab_order={};
        $('#change-order li').each(function(){
            tab_order[$(this).index()]=$(this).find('a').attr('data-value');

        });
            var promo = $('.btn-group .btn-primary').html();
            
            if(promo == "Fichiers communs") {
                promo = "TOUTES";
            }
            console.log(promo);
            
            var tabjsn = JSON.stringify(tab_order);
            console.log(tabjsn);
            $.ajax({
                url: 'ajax/changeOrder.php',
                type:  'POST',
                data: 'tabjsn=' + tabjsn + '&promo=' + promo, 
                success : function(code_html, statut){
                    addToast('Modifications sauvegardées', 'toast-success');
                    console.log(code_html);
                },
                error : function(resultat, statut, erreur){
                    $('tr').removeClass('suppr');
                }
            });
        });  
        
    });
        
    /*------------------------------------------------------------*/
    /*------JSON des promotions associées à un fichier ajouté-----*/
    /*------------------------------------------------------------*/
        
    $(document).on('click', '#ajout-fichier-modal .promo-associees-section input', function() {
        
        var promos = [];
        
        $('#ajout-fichier-modal .promo-associees-section input:checked').each(function() {
            promos.push($(this).attr('name'));
        });
        
        if(promos.length != 0) {
            $('#ajout-fichier-modal .promo-associees-section .promos-checked').val(JSON.stringify(promos));
            
            if(promos[0] == 'TOUTES') {
                $('#ajout-fichier-modal .promos-12 input, #ajout-fichier-modal .promos-345 input').each(function() {
                    $(this).prop("disabled", true);
                });
            } else if(promos[0].indexOf("A3") >= 0 || promos[0].indexOf("A4") >= 0 || promos[0].indexOf("A5") >= 0) {
                $('#ajout-fichier-modal .promos-12 input, #ajout-fichier-modal .promos-all input').each(function() {
                    $(this).prop("disabled", true);
                });
            } else if(promos[0].indexOf("A1") >= 0 || promos[0].indexOf("A2") >= 0) {
                $('#ajout-fichier-modal .promos-345 input, #ajout-fichier-modal .promos-all input').each(function() {
                    $(this).prop("disabled", true);
                });
            }
            
        } else {
            $('#ajout-fichier-modal .promo-associees-section .promos-checked').val("");
            
            $('#ajout-fichier-modal .promo-associees-section input').each(function() {
                    $(this).prop("disabled", false);
            });
        }
        
        console.log($('#ajout-fichier-modal .promo-associees-section .promos-checked').val());
        
    });
    
    /*------------------------------------------------------------*/
    /*------JSON des promotions associées à un fichier modifié----*/
    /*------------------------------------------------------------*/
        
    $(document).on('click', '#modification-modal .promo-associees-section input', function() {
        
        var promos = [];
        
        $('#modification-modal .promo-associees-section input:checked').each(function() {
            promos.push($(this).attr('name'));
        });
        
        if(promos.length != 0) {
            $('#modification-modal .promos-checked').val(JSON.stringify(promos));
            
            if(promos[0] == 'TOUTES') {
                $('#modification-modal .promos-12 input, #modification-modal .promos-345 input').each(function() {
                    $(this).prop("disabled", true);
                });
            } else if(promos[0].indexOf("A3") >= 0 || promos[0].indexOf("A4") >= 0 || promos[0].indexOf("A5") >= 0) {
                $('#modification-modal .promos-12 input, #modification-modal .promos-all input').each(function() {
                    $(this).prop("disabled", true);
                });
            } else if(promos[0].indexOf("A1") >= 0 || promos[0].indexOf("A2") >= 0) {
                $('#modification-modal .promos-345 input, #modification-modal .promos-all input').each(function() {
                    $(this).prop("disabled", true);
                });
            }
            
        } else {
            $('#modification-modal .promos-checked').val("");
            
            $('#modification-modal .promo-associees-section input').each(function() {
                    $(this).prop("disabled", false);
            });
        }
        
        console.log($('#modification-modal .promos-checked').val());
             
    });
	
	/*------------------------------------------------------------------*/
    /*------JSON des données personnelles que l'on souhaite exporter----*/
    /*------------------------------------------------------------------*/
        
    $(document).on('click', '#export-modal .personaldata-chooser-section input, #export-btn, #datedeb, #datefin', function() {
        
        $('#export-modal .download-section').html("");
        
        var perso = [];
        
        $('#export-modal .personaldata-chooser-section input:checked').each(function() {
            perso.push($(this).attr('name'));
        });
        
        if(perso.length != 0) {
            $('#export-modal .perso-checked').val(JSON.stringify(perso));
        } else {
            $('#export-modal .perso-checked').val("");
        }
        
        console.log($('#export-modal .perso-checked').val());
             
    });


    /*--------------------------------------*/
    /*------Activation des datepickers------*/
    /*--------------------------------------*/
    
    $(function() {
        var pickerdatedeb = new Pikaday({ 
            field: $('.datepicker')[0],
            format: 'DD/MM/YYYY'
        });
        
        var pickerdatefin = new Pikaday({ 
            field: $('.datepicker')[1],
            format: 'DD/MM/YYYY'
        });
        
         var pickernaissance = new Pikaday({ 
            field: $('.datepicker')[2],
            format: 'DD/MM/YYYY'
        });
        
    });
    
    
});


    /*--------------------------------------*/
    /*---------Affichage des toasts---------*/
    /*--------------------------------------*/

    function addToast(content, state) {
        
        /*var toast = '<div class="toast">'+content+'</div>';
        $(toast).hide().appendTo('#toast-container').fadeIn(500).delay(2000).fadeOut(500);*/
        
        var toast = '<div class="'+state+' largetoast alert-dismissible alert-success"><span>'+content+'</span></div>';
        $(toast).appendTo('.main-content');
        $('.largetoast').delay(20).animate({opacity: 1, bottom: "30px"}, 45).delay(3000).animate({opacity: 0, bottom: "45px"}, 45).delay(150).hide(0);
    }