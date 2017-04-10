$(document).ready(function(){
$.ajax({
        type: 'POST',
        url: '../php/test.php',
        dataType: 'json',
        success: function (data) {
            processData(data);
        },
        error: function(jqXHR, textStatus){ 
            console.log("FAIL");
            console.log("error " + textStatus);
            console.log("incoming Text " + jqXHR.responseText);
        }

    });
});

function processData(data) {

    //total sum vals
    var totalEmpFtStud = 0;
    var totalEmpPtStud = 0;
    var totalContEdEnrolled = 0;
    var totalContEdPlanning = 0;
    var totalMil = 0;
    var totalVol = 0;
    var totalSeek = 0;
    var totalNotSeek = 0;
    var totalStud = 0;

    //undergrad sum vals
    var ugEmpFtSum = 0;
    var ugEmpPtSum = 0;
    var ugContEnSum = 0;
    var ugContPlSum = 0;
    var ugSeekSum = 0;

    //ms sum vals
    var msEmpFtSum = 0;
    var msEmpPtSum = 0;
    var msContEnSum = 0;
    var msContPlSum = 0;
    var msSeekSum = 0;

    //phd sum vals
    var phdEmpFtSum = 0;
    var phdEmpPtSum = 0;
    var phdContEnSum = 0;
    var phdContPlSum = 0;
    var phdSeekSum = 0;

    //top level sums
    var bachTotal = 0;
    var msTotal = 0;
    var phdTotal = 0;

    //Arrays for holding campus and majors
    var bsCampus = [];
    var msCampus = [];
    var phdCampus = [];
    var bsMajor = [];
    var msMajor = [];
    var phdMajor = [];

    //Iterate through each array and fill values in
    $.each(data, function(key, val){

        //First Setup grandTotals
        if (val.EmpFT != null){
            totalEmpFtStud += parseInt(val.EmpFT);
        }

        if (val.EmpPT != null){
            totalEmpPtStud += parseInt(val.EmpPT);
        }

        if (val.ContEdEnrolled != null){
            totalContEdEnrolled += parseInt(val.ContEdEnrolled);
        }

        if (val.ContEdPlanning != null){
            totalContEdPlanning += parseInt(val.ContEdPlanning);
        }

        if (val.Seeking != null){
            totalSeek += parseInt(val.Seeking);
        }
        //Set Top Level Sums
        if(val.level == "Undergradu"){
            if (val.EmpFT != null){
                ugEmpFtSum += parseInt(val.EmpFT);
            }

            if (val.EmpPT != null){
                ugEmpPtSum += parseInt(val.EmpPT);
            }

            if (val.ContEdEnrolled != null){
                ugContEnSum += parseInt(val.ContEdEnrolled);
            }

            if (val.ContEdPlanning != null){
                ugContPlSum += parseInt(val.ContEdPlanning);
            }

            if (val.Seeking != null){
                ugSeekSum += parseInt(val.Seeking);
            }

            bachTotal+= parseInt(val.Graduates);;
        }

        if(val.level == "Graduate"){
            if (val.EmpFT != null){
                msEmpFtSum += parseInt(val.EmpFT);
            }

            if (val.EmpPT != null){
                msEmpPtSum += parseInt(val.EmpPT);
            }

            if (val.ContEdEnrolled != null){
                msContEnSum += parseInt(val.ContEdEnrolled);
            }

            if (val.ContEdPlanning != null){
                msContPlSum += parseInt(val.ContEdPlanning);
            }

            if (val.Seeking != null){
                msSeekSum += parseInt(val.Seeking);
            }

            msTotal+= parseInt(val.Graduates);
        }

        if(val.level == "Doctoral"){
            if (val.EmpFT != null){
                phdEmpFtSum += parseInt(val.EmpFT);
            }

            if (val.EmpPT != null){
                phdEmpPtSum += parseInt(val.EmpPT);
            }

            if (val.ContEdEnrolled != null){
                phdContEnSum += parseInt(val.ContEdEnrolled);
            }

            if (val.ContEdPlanning != null){
                phdContPlSum += parseInt(val.ContEdPlanning);
            }

            if (val.Seeking != null){
                phdSeekSum += parseInt(val.Seeking);
            }

            phdTotal+= parseInt(val.Graduates);;
        }

        totalStud += parseInt(val.Graduates);

        //Build Rows in Table and Populate with Arrays
        

    });
    
    //Append grandTotals
    $('#grandTotals').append('<tr class="info"><th>Grand Totals</th><th>'+ totalEmpFtStud +'</th><th>'+ makePercent(totalEmpFtStud, totalStud) +'</th><th> '+ totalEmpPtStud +' </th><th> '+ makePercent(totalEmpPtStud,totalStud) +' </th><th> '+totalContEdEnrolled+' </th><th> '+ makePercent(totalContEdEnrolled, totalStud) +'</th><th> '+totalContEdPlanning+' </th><th> '+makePercent(totalContEdPlanning, totalStud)+' </th><th> '+totalSeek+' </th><th> '+makePercent(totalSeek, totalStud)+'</th><th>'+totalStud+' </th></tr>');
    //Append Bachelor Totals
    $('#bsInsertAfter').after('<td> '+ ugEmpFtSum +' </td><td>'+makePercent(ugEmpFtSum, bachTotal)+'<td> '+ ugEmpPtSum +' </td> <td>'+makePercent(ugEmpPtSum, bachTotal)+'<td> '+ugContEnSum+'</td><td>'+makePercent(ugContEnSum, bachTotal)+'</td><td>'+ugContPlSum+'</td><td>'+makePercent(ugContPlSum, bachTotal)+'</td><td>'+ugSeekSum+'</td><td>'+makePercent(ugSeekSum,bachTotal)+'</td><td>'+bachTotal+'</td>');
    $('#msInsertAfter').after('<td> '+ msEmpFtSum +' </td><td>'+makePercent(msEmpFtSum, msTotal)+'<td> '+ msEmpPtSum +' </td> <td>'+makePercent(msEmpPtSum, msTotal)+'<td> '+msContEnSum+'</td><td>'+makePercent(msContEnSum, msTotal)+'</td><td>'+msContPlSum+'</td><td>'+makePercent(msContPlSum, msTotal)+'</td><td>'+msSeekSum+'</td><td>'+makePercent(msSeekSum,msTotal)+'</td><td>'+msTotal+'</td>');
    $('#phdInsertAfter').after('<td> '+ phdEmpFtSum +' </td><td>'+makePercent(phdEmpFtSum, phdTotal)+'<td> '+ phdEmpPtSum +' </td> <td>'+makePercent(phdEmpPtSum, phdTotal)+'<td> '+phdContEnSum+'</td><td>'+makePercent(phdContEnSum, phdTotal)+'</td><td>'+phdContPlSum+'</td><td>'+makePercent(phdContPlSum, phdTotal)+'</td><td>'+phdSeekSum+'</td><td>'+makePercent(phdSeekSum,phdTotal)+'</td><td>'+phdTotal+'</td>');

    //Build Doctorate Majors
    $('#msBody').after('<tbody><th> </th><td>'+ phdEmpFtSum +' </td><td>'+makePercent(phdEmpFtSum, phdTotal)+'<td> '+ phdEmpPtSum +' </td> <td>'+makePercent(phdEmpPtSum, phdTotal)+'<td> '+phdContEnSum+'</td><td>'+makePercent(phdContEnSum, phdTotal)+'</td><td>'+phdContPlSum+'</td><td>'+makePercent(phdContPlSum, phdTotal)+'</td><td>'+phdSeekSum+'</td><td>'+makePercent(phdSeekSum,phdTotal)+'</td><td>'+phdTotal+'</td></tbody>');
}

function makePercent(intIn, total){
    return Math.round(  (intIn / total) * 100) +'%';
}