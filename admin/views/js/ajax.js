$(document).ready(function() {
    
    /*--------------------------------------*/
    /*----Envoi des formulaires en ajax-----*/
    /*--------------------------------------*/
    
    // On récupère les atributs action et method des formulaires
    // et on sérialise les données associées
    
    $(".ajax-form").submit(function(e){
        e.preventDefault(); // On empéche l'envoi du formulaire par le navigateur
        $.ajax({
            url: $(this).attr('action'),
            type:  $(this).attr('method'),
            data: $(this).serialize()
        });
        
    });
    
    /*--------------------------------------*/
    /*----------SECTION PROMOTIONS----------*/
    /*--------------------------------------*/
    
    /*MODIFICATION D'UNE PROMOTION*/
    
    /*Au clic sur le bouton modifier, on envoit les informations correspondantes dans la modale*/
    
    $(document).on('click', '.modification-modal-button', function(){
        var nompromo = $(this).parents('tr').find('.nom').text();
        var libellepromo = $(this).parents('tr').find('.libelle').text();
        
        // PEUT ETRE REGROUPE EN DEUX LIGNES 
        $('#modification-modal').find('#input-nom').val(nompromo);
        $('#modification-modal').find('#input-libelle').val(libellepromo);
        $('#modification-modal').find('#input-nom-original').val(nompromo);
        $('#modification-modal').find('#input-libelle-original').val(libellepromo);
        
        // Permet de savoir quel element est en cours de modification
        $('tr').removeClass('modif');
        $(this).parents('tr').addClass('modif');
    });
    
    /*SUPPRESSION D'UNE PROMOTION*/
    
    /*Au clic sur le bouton, on remplis les champs du popover de confirmation*/
    
    $(document).on('click', '.suppression-popover', function(){
        var nompromo = $(this).parents('tr').find('.nom').text();
        var libellepromo = $(this).parents('tr').find('.libelle').text();
        $('.nom-promo-a-suppr').attr('value', nompromo);
        $('.libelle-promo-a-suppr').attr('value', libellepromo);
    });
    
    /*Puis, si l'utilisateur confirme la suppression, on fait un appel AJAX*/
    
    $(document).on('click', '.ajax-delete', function(){
        
        $(this).parents('tr').addClass('suppr');
        
        $.ajax({
            url: 'ajax/deletePromotion.php',
            type:  'POST',
            data: 'nom=' + $('.nom-promo-a-suppr').attr('value') + '&libelle=' + $('.libelle-promo-a-suppr').attr('value'),
            success : function(code_html, statut){
                $('.suppr').hide();
                addToast('Promotion supprimée', 'toast-success');
                
            },
            error : function(resultat, statut, erreur){
                $('tr').removeClass('suppr');
            }
        });
        
    });
    
    
    /*--------------------------------------*/
    /*-----------SECTION FICHIERS-----------*/
    /*--------------------------------------*/
    
    $('.table-fichiers tr').each(function() {
        
        $(this).addClass('current-fichier');
        var $t = $(this);
        
        $.ajax({
            url: 'ajax/getPromotionsAssociees.php',
            type:  'POST',
            data: 'fichier='+$('.current-fichier').find('.libelle a').attr('data-url'),
            success : function(code_html, statut) {
                console.log(code_html);
                var obj = $.parseJSON(code_html);
                
               $.each(obj, function(key, value) {
                    if(value == "checked") {
                        $t.find('.promos-fichier').append('<span class="label label-primary">'+key+'</span> ');
                    }
               });
            }
        });
        
        $(this).removeClass('current-fichier');
        
    });
    
    /*MODIFICATION D'UN FICHIER*/
    
    /*Au clic sur le bouton modifier, on envoit les informations correspondantes dans la modale*/
    
    $(document).on('click', '.modification-promo-modal-button', function(){
        
        var fichier = $(this).parents('tr').find('.libelle a').attr('data-url');
        var nom = $(this).parents('tr').find('.libelle a').text();
        
        $('#modification-modal').find('#input-libelle').val(fichier);
        $('#modification-modal').find('#input-nom').val(nom);
        
        $('#modification-modal .promos-12, #modification-modal .promos-345, #modification-modal .promos-all').empty();
        
        // Récupération de toutes les promotions (a faire avant en php ????)
        // Récupération de la liste des promotions associées
        
        $.ajax({
            url: 'ajax/getPromotionsAssociees.php',
            type:  'POST',
            data: 'fichier='+$('#modification-modal').find('#input-libelle').val(),
            success : function(code_html, statut){
                var obj = $.parseJSON(code_html);
                
                var all = false;
                var a345 = false;
                var a12 = false;
                $.each(obj, function(key, value) {
                    var checkbox = '<span><input name="'+key+'" type="checkbox" '+value+'><span>'+ key+'</span></span>';
                    
                    if(key == "TOUTES") {
                        $('#modification-modal .promos-all').append(checkbox);
                        if(value == "checked") {
                            all = true;
                        }
                    } else if (key.indexOf("A3") >= 0 || key.indexOf("A4") >= 0 || key.indexOf("A5") >= 0) {
                        $('#modification-modal .promos-345').append(checkbox);
                        if(value == "checked") {
                            a345 = true;
                        }
                    } else if (key.indexOf("A1") >= 0 || key.indexOf("A2") >= 0) {
                        $('#modification-modal .promos-12').append(checkbox);
                        if(value == "checked") {
                            a12 = true;
                        }
                    }
                    
                    var promos = [];
                    $('#modification-modal .promo-associees-section input:checked').each(function() {
                        promos.push($(this).attr('name'));
                    });
                    
                    $('#modification-modal .promos-checked').val(JSON.stringify(promos));
                    
                });
                
                console.log(all);
                
                if(all == true) {
                    $('#modification-modal .promos-12 input, #modification-modal .promos-345 input').each(function() {
                        $(this).prop("disabled", true);
                    });
                } else if(a345 == true) {
                    $('#modification-modal .promos-12 input, #modification-modal .promos-all input').each(function() {
                        $(this).prop("disabled", true);
                    });
                } else if(a12 == true) {
                    $('#modification-modal .promos-345 input, #modification-modal .promos-all input').each(function() {
                        $(this).prop("disabled", true);
                    });
                }
                
                console.log($('#modification-modal .promos-checked').val());
                
            },
            error : function(resultat, statut, erreur){
                alert(erreur);
            }
        });
        
        
    });
    
    /*SUPPRESSION D'UN FICHIER*/
    
    /*Au clic sur le bouton, on remplis les champs du popover de confirmation*/
    
    $(document).on('click', '.suppression-fichier-popover', function() {
        var fichier = $(this).parents('tr').find('.fichier a').text();
        $('.fichier-a-suppr').attr('value', fichier);
    });
    
    /*Puis, si l'utilisateur confirme la suppression, on fait un appel AJAX*/
    
    $(document).on('click', '.ajax-delete-fichier', function(){
        
        $(this).parents('tr').addClass('suppr');
        $.ajax({
            url: 'ajax/deleteFichier.php',
            type:  'POST',
            data: 'fichier='+$('.fichier-a-suppr').attr('value'),
            success : function(code_html, statut){
                $('.suppr').hide();
                addToast('Le fichier à été définitivement supprimé', 'toast-success');
            },
            error : function(resultat, statut, erreur){
                $('tr').removeClass('suppr');
            }
        });
        
    });
    
    /*--------------------------------------*/
    /*-----SECTION DONNEES PERSONNELLES-----*/
    /*--------------------------------------*/
    
    /*MODIFICATION D'UNE LIGNE*/
    
    /*Au clic sur le bouton modifier, on envoit les informations correspondantes dans la modale*/
    
    $(document).on('click', '.modification-data-modal-button', function(){
        
        var id = $(this).attr('data-id');
        var identifiant = $(this).parents('tr').find('.identifiant').text();
        var nom = $(this).parents('tr').find('.nom').text();
        var prenom = $(this).parents('tr').find('.prenom').text();
        var naissance = $(this).parents('tr').find('.naissance').text();
        var tel = $(this).parents('tr').find('.tel').text();
        var courriel = $(this).parents('tr').find('.courriel').text();
        var date = $(this).parents('tr').find('.date').text();
        var ip = $(this).parents('tr').find('.ip').text();
        
        $('#modification-modal').find('#input-id').val(id);
        $('#modification-modal').find('#input-identifiant').val(identifiant);
        $('#modification-modal').find('#input-nom').val(nom);
        $('#modification-modal').find('#input-prenom').val(prenom);
        $('#modification-modal').find('#input-naissance').val(naissance);
        $('#modification-modal').find('#input-tel').val(tel);
        $('#modification-modal').find('#input-courriel').val(courriel);
        $('#modification-modal').find('#input-date').val(date);
        $('#modification-modal').find('#input-ip').val(ip);
    });
    
    /*SUPPRESSION D'UNE LIGNE*/
    
    /*Au clic sur le bouton, on remplis les champs du popover de confirmation*/
    
    $(document).on('click', '.suppression-data-popover', function(){
        var id = $(this).attr('data-id');
        $('.id-data-a-suppr').attr('value', id);
    });
    
    /*Puis, si l'utilisateur confirme la suppression, on fait un appel AJAX*/
    
    $(document).on('click', '.ajax-delete-data', function(){
        
       $(this).parents('tr').addClass('suppr');
        
        $.ajax({
            url: 'ajax/deleteData.php',
            type:  'POST',
            data: 'id=' + $('.id-data-a-suppr').attr('value'),
            success : function(code_html, statut){
                $('.suppr').hide();
                addToast('Les données ont été supprimées', 'toast-success');
            },
            error : function(resultat, statut, erreur){
                $('tr').removeClass('suppr');
            }
        });
    });
    
    /*SUPPRESSION TOTALE*/
    
    $(document).on('click', '#delete-all-data', function() {
        $.ajax({
            url: 'ajax/deleteAllData.php',
            type:  'POST',
            success : function(code_html, statut){
                addToast('Toutes les données personnelles ont été supprimées', 'toast-success');
                $('.dataTable').find('tbody').html('');
            },
            error : function(resultat, statut, erreur){
                addToast('Suppression impossible', 'toast-warning');
            }
        });
    });
    
    /*EXPORT*/
    
    $(document).on('click', '#export-pdf', function() {
        
        var datedeb = $('#datedeb').val();
        var datefin = $('#datefin').val();
        
        if(datedeb == '') {
            datedeb = '01/01/2002';
        }
        
        if(datefin == '') {
            datefin = '01/01/2020';
        }
        
        $.ajax({
            url: 'ajax/exportPDF.php',
            type:  'POST',
			data: 'persojsn=' + $('.perso-checked').val() + '&datedeb=' + datedeb + '&datefin=' + datefin,
            success : function(code_html, statut){
                var fichier = '<div class="success-panel"><a class="success-a" href="../pdf/datas.pdf" download="datas.pdf">Télécharger le document PDF</a></div>';
                $('#export-modal .download-section').html(fichier);
            },
            error : function(resultat, statut, erreur){
                
            }
        });
    });
    
    $(document).on('click', '#export-csv', function() {
        
        var datedeb = $('#datedeb').val();
        var datefin = $('#datefin').val();
        
        if(datedeb == '') {
            datedeb = '01/01/2002';
        }
        
        if(datefin == '') {
            datefin = '01/01/2020';
        }
        
        $.ajax({
            url: 'ajax/exportCSV.php',
            type:  'POST',
			data: 'persojsn=' + $('.perso-checked').val() + '&datedeb=' + datedeb + '&datefin=' + datefin,
            success : function(code_html, statut){
                var fichier = '<div class="success-panel"><a class="success-a" href="../pdf/datas.csv" download="datas.csv">Télécharger le document CSV</a></div>';
                $('#export-modal .download-section').html(fichier);
				console.log(code_html);
            },
            error : function(resultat, statut, erreur){
                
            }
        });
    });
        
});