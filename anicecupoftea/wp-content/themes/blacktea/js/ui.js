$(document).ready(function() {
    var s = "znvygb:uryyb@oynpxgrnpbzvpf.pbz";
    String.prototype.rot13 = function(){
        return this.replace(/[a-zA-Z]/g, function(c){
            return String.fromCharCode((c <= "Z" ? 90 : 122) >= (c = c.charCodeAt(0) + 13) ? c : c - 26);
        });
    };
    $('.mail a').each(function(){
        $(this).attr('href',s.rot13());
    });
});
