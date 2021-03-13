function addBadge( badge ){
    $('#badgesTable > tbody').append('<tr> <td>'+ badge.firstName + ' ' + badge.lastName + '</td><td>' + badge.email + '</td><td>' + badge.jobTitle + '</td><td>' + badge.twitter + '</td><td>' + badge.avatarUrl + '</td> </tr>');
}

$('#loadBadges').click( function(){
    $('#messages').first('p').text('Cargando badges...');
    $('#messages').show();
    $.ajax(
        {
            'url': 'http://localhost/api_rest/router.php/badges',
            'success': function( data ){
                $('#messages').hide();
                $('#badgesTable > tbody').empty();
                for(badge in data){
                   addBadge( data[ badge ] ); 
                }
                $('#badgeForm').show();
            },
        }
    );
} );

$('#badgeSave').click( function(){
    let newBadge = {
        'firstName': $('#badgeFirstName').val(),
        'lastName': $('#badgeLastName').val(),
        'email': $('#badgeEmail').val(),
        'jobTitle': $('#badgeJob').val(),
        'twitter': $('#badgeTwitter').val(),
        'avatarUrl': $('#badgeAvatar').val()
    }

    $('#messages').first('p').text('Guardando Badge...');
    $('#messages').show();
    $.ajax(
        {
            'url': 'http://localhost/api_rest/router.php/badges',
            'method': 'POST',
            'data': JSON.stringify( newBadge ),
            'success': function(){
                $('#messages').hide();
                addBadge( newBadge );
                $('input[type=text]').val('');
            }
        }
    );
});