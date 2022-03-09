window.addEventListener('load', function() {
    var url = document.location.href;
    if (url.includes('tasks')) {
        if (!document.getElementById('performance').classList.contains('selectedLink')) {
            document.getElementById('performance').classList.add('selectedLink');
        }
    } else if (url.includes('location') ) {
        if (!document.getElementById('paywall').classList.contains('selectedLink')) {
            document.getElementById('paywall').classList.add('selectedLink');
        }
    }else if (url.includes('users') ) {
        if (!document.getElementById('users').classList.contains('selectedLink')) {
            document.getElementById('users').classList.add('selectedLink');
        }
    }
});
window.addEventListener('load', function() {
    var performance=document.getElementById('performance');
    if(performance){
        performance.addEventListener('click', function() {
            if (!document.getElementById('performance').classList.contains('selectedLink')) {
                document.getElementById('performance').classList.add('selectedLink');
                document.getElementById('paywall').classList.remove('selectedLink');
                document.getElementById('users').classList.remove('selectedLink');

            }
        });
    }


    document.getElementById('paywall').addEventListener('click', function() {
        if (!document.getElementById('paywall').classList.contains('selectedLink')) {
            document.getElementById('paywall').classList.add('selectedLink');
            document.getElementById('performance').classList.remove('selectedLink');
            document.getElementById('users').classList.remove('selectedLink');


        }
    });
    document.getElementById('users').addEventListener('click', function() {
        if (!document.getElementById('users').classList.contains('selectedLink')) {
            document.getElementById('users').classList.add('selectedLink');
            document.getElementById('paywall').classList.remove('selectedLink');
            document.getElementById('performance').classList.remove('selectedLink');


        }
    });

});

// function checklist_redirects() {
//     if(!document.getElementById('settings').classList.contains('selectedLink')){
//         document.getElementById('settings').classList.add('selectedLink');
//             document.getElementById('performance').classList.remove('selectedLink');
//             document.getElementById('subscribers').classList.remove('selectedLink');
//             document.getElementById('ab-test').classList.remove('selectedLink');
//             document.getElementById('paywall').classList.remove('selectedLink');
//     }
// }

// document.getElementById('checklistIntegration').addEventListener('click', checklist_redirects);
