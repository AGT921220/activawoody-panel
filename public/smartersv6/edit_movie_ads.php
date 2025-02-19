<?php
/*
 ____       _   ____     _____                _   _                 
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMWWNNNNWMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMWX0koc:,,,;lxKNMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMN0d:'....',,,'...;dKWMMMMMMMMMMMWNNWMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMWWWWMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMWKd;...;ldkO0KKK0Od,. .l0WMMMMMWXkoc;;:d0NWMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMWWWWMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMWWNXXK0000KKXNNWWMMMMMMMMMMMMMMMMMMMMMMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMNOc..'cxOKXKKKKKKKKKK0x;. .oXMMW0l'...''...,l0WMMMMMMMMMMMMMMMMMMMMMMMMMMMWWNX0Okxdolcccd0NWMMMMMMMMMMMMMMMMMMMMMMMWNKkddolc:;;;::lodkOKNWMMMMMMMMMMMMMMMMMMMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMWOc..:d0XXXKKKKKKKKKKKKKK0l.  lXXo'.;ok00K0d,  'xNMMMMMMMMMMMMMMMMMMMMMWNKkdc;,.............,l0WMMMMMMMMMMMMMMMMMWXOdc,..',,'..    ....,:ldOKNWMMMMMMMMMMMMMMMMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMWKl..ckKXXXKKKKKKKKKKKKKKKKKO:  .:;.;xXNXKKKKKO:. .oKMMMMMMMMMMMMMMMMWXOdc,....';:lodxkkOO0Od,  'dKWMMMMMMMMMMMMWXxc'. .,ldkkkkxdlc;,..   ..';lx0XWWMMMMMMMMMMMMMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMNd'.:kKXXKKXNNXKKKKKKKKKKKKKKKd.   .oKWNXKKKKKKK0o.  ;0WMMMMMMMMMMWNKxc'...,coxO0KKKXXKKKKKKKKkc,. .c0WMMMMMMMMWKo'   .:xKKXKKKKKXXX0xoll:,.  ..,cdOKNWMMMMMMMMMMMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMW0c.,dKXXKKXNNNXKKK0KKKKK0KK00KKk'  .dXWXKKKKKKKKKKKd.  ,0MMMMMMMWKx:,...;lxOKKKKKKKKKKKKKKKKKKKKKKd'  ,0WMMMMMMWO;   .:x0XKKKKKKKKKKKOo:,,,:c;.   .':okKNWMMMMMMMMMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMWk,.lOXXXKXNNXKK00KKK00000000000Kk, .dXNKKKKKKKKKKKKKKc   cXMMMWXkc'..,:dOKKKKKKKKKKKKKKKKKKKKKKKKXNXo.  :KWMMMMW0:  .lOKKKKKKKKKKKKKKKK0Oxoc,...     .':dOKNWMMMMMMMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMNd''dKXXKXNNXK000K0kdc;;,ck0000000k,.cKNK00KXNNNXK00KXXx.  .kWWKo,..;d0KXNXK0KKKKKKKKKKKKKKKKKK0KKKNWNx.  .dNWWWNk;  'xKXKKKKKKKKKK0KKK0KKKKK0Oxl,.      .,cdOXNWWMMMMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMNd.,kKXKKXNX00000Oo;...coocd0K00000k,,ONK00KXWWNK00000XNO,   :xc..'lkKNNNNXKK000000000000000000000KXWMNx'   cXWWNk,  .oKXNXK0KKKK0KKXXXXXKKK000K00Od;.     ..;lxOXNWMMMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMWx';kXXKKXXK0000kl'..'...,cxOKK00000o'lXX00KNWNKkc:d000KN0;    ..:d0XNNXKK00000000000000KKKKKKKKXXXXNWNXo''. ;XWN0c.  ,kKNWX00000000KXNNNWWWNNXK00000Od,.     ..;lk0XWWMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMO,,xKXKKXK0O0000x'.:lc'    .dKX0O00Oc'xK000XWN0o. .l000XNK:   'ck00KKK00000000000KKKKXXXNXXXXXXXXXXKKK0x'';. ;KWN0:   :OXNWX00000000kxkOKKXNNWWWNK00000kc. .'.  .':dOXNWMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMXc'dKXK0XKOOOOOO0x,';.      .lKX0OO0k;;k000KNN0l.':''dO0NN0:.'oO000000000OO000000KXNXKXKK00Okxddoollcc:;..c:. :XWN0l.  :OKNWX000000K0l...;lxOKXNWMWNK0000Ol',dc.  ..;okKNWMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMWk,c0XKOKKOOkloOOOk;.        .xXKOOOOx,:O0O0XWKd''oc. .:kKXk,,x0000O0OOOO0KKXNX0OO00OOkdc:,'.............,ll.  lNMWNk,  ;kKNWWX00000KO:  ....'lk0KNWWWX0000OxdkO:    .,lkKNWMMM
MMMMMMMMMMMMMMMMMMMMMMMMMNl,xXXOOOOOkl.:kOOk:.   ,c,  c0XKOOOOd':OOO0XNO;.l:.    ;xx:.cOOOOOOOO0KXNNNNXKOOOOo,;c'...',,;;;;;;;;,,;;,.  'OMMMMNo. .d0XWWWX0OOkd;. .cdl,. .lk0KNWWX0OO0OO00x'    .;oOXNWMM
MMMMMMMMMMMMMMMMMMMMMMMMMK:;OX0OOOOdl:.;kOOkc.. .kWk.'xXXOOOOOc.:kOOOXXx',c.      ....cOOOOOO0XNWNXK00kxOOOO: .c,':;;,'.....          .dWMMMMMXo. ,x0KXXK0x;.     .;lxo;. ,dOKNWWXOOOOOO00c    .'cxKNWMM
MMMMMMMMMMMMMMMMMMMMMMMMMK::OKOkkOx,,:.,xOkkc.. .xK:'o0X0kkOOx, ;kOOOKKo';,  ,:.   .,.,xOOOOKNNXK0xlc;.:kOOk: .c,..                  .dNMMMMMMW0:...cdxxxl'         .,lxl. .dOKNWN0OOOOOO0o.   .'cxKNWMM
MMMMMMMMMMMMMMMMMMMMMMMMMNc,dOOkkk:.,:.'xkkkc.. .lc.cOX0kkkkkc. ,xOkk00o'.. .xXd.   .  :kOkk0K0ko;.....;kOOk: .c,..      ....'',,;;:d0WMMMMMMMMNkl;......             .:dl. ,x0KWN0kOOOOOOd'  ..:dOXWWMM
MMMMMMMMMMMMMMMMMMMMMMMMMWd.'lxkOd. ,c.'dkkkl..  ..ckKKkkkkkd'','lkkkkOx,   .,;,.      .okkkkxc'..':l:.:00kk: .c,.. .:oxkO0KKXNNNWWWMMMMMMMMMMMMWX0kdl:,'......';:'     ,o:..ckKNXOkkOOOOOd.  .,lkKNWMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMk.  .::'..,c..dkkkl'.  .:kKKkkkkkx;.::.;xkkkkko:'...',,;;.    ;xkkx:..:ll;'. :00kk: .c,.. ,0MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMWXOxdddddxk0K0o.    ,;..:k0K0kkkkkkkOl.  .:d0XWMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMK,     .:,;c..okxkl'. .ckK0kxxxxxc.;l. .lkxxxkkkkxxxxkkkkx:.  .lkkx:.:c'.    :00xkc ...'. ,0MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMWNNXXXXXXKK0xc.       .oOOkkkkkkkkOk;  .,lkKNWMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMWd.   .,;..,..oxxko. .ckK0kxxxxxl.'l;   'dkxxxxxxxxxxxxxxxd:.  'dkx:..       cKOxxc.  .;. ,0MMMMMMMMMMMMMMMMMMMMMMMMMMMMMWXK0000OOOOkdoc;'...'',;coxkkkkkkkkkkko. .,cx0XWMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMXl.         .oxxxo''oOK0kxxxxxo'.lc.    'oxxxxxxxxxxxxxxxkkl.  ,dd,''   ,c;.cKOxxc..  .  ;KMMMMMMMMMMMMMMMMMMMMMMMMMWN0o:,cdkkkkkkkkkkxxxxxxxkkkkkkxxxxxxxxkko'..,lx0XWMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMNx;.       .oxxxdldOKOxxxxxxo'.cl.  ,,  .cxxxxxxxxxxxxxxOKO;   ...;,  cXWO;lKOxxc..     lNMMMMMMMMMMMMMMMMMMMMMMMWXx:...:dkkxxxxxxxxxxxxxxxxxxxxxxxxxxxxxkxc...,lkKNWMMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMNOc,,;.  .lxxxxk00kxxxxxxo'.cl.  ,Ok.  .oxxxxxxxxxkkk0XNO:.    ;l. .xWMO,lKOxxc'.    ,OMMMMMMMMMMMMMMMMMMMMMMMXx;. ,oxkkxxxxxxxxxxxxxxxxxxxxxxxxxxxxxkxl'. .,lkKNWMMMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMWNNNd. .oxxxk00xxxxxxxo'.cl'  .kWNo..:dxxxxdxOKXX0O00Od,..   ..  '0MMO,l0kdxc'.  .c0WMMMMMMMMMMMMMMMMMMMMMMKl.  .okOXXOxdxxxxxxxxxxxxxxxxxxxxxxxxxd:.    .:d0XWMMMMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMK; .oxxxxkxdxxxxdc..cl'  .dNMWd.;dxxddxOXNX0kxdllc,.;;       lNMMk,ckxdx:..  lNMMMMMMMMMMMMMMMMMMMMMMWXo.   'ok0NWNKOOkxxkkxxxxxxxxxxxxxxxxxxxc.    ..:d0XWMMMMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMNd..cddddddddddddl. ...  .oNMMK;,oddddkKNXOxl:c:....:o'     .cKMMWk,cdddd:..  lNMMMMMMMMMMMMMMMMMMMMMMWO, .,..;dkO0000K0kOKXXXKK0Okxxddxxxxxxxxxo,.   .,lkKNWMMMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMWk',oxddddddddddddolc;'.  'kNMWd'cddddkXN0xl,. ;;.,::c,  .odokNMMWWx,cdddd:..  lNMMMMMMMMMMMMMMMMMMMMMMW0:.'oc. .;loooodddxkkO00KXNNXK0kxdddddxddxdl'  ..:d0XWMMMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMNl'oOOxddddddddddddddddl;. .:k0:,odddxKN0d;..'.,;.'.     lNMMMMMMWWx,cdddd:..  lNMMMMMMMMMMMMMMMMMMMMMMWNO:.:do:........'lxl;:lodxO0KNWNX0kddddddddxd:. .,lkKNWMMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMXc,x0kdddddddddddddddddddo:. .'.;ddod0N0d,.,oc.,;..    .cKWWMMMMMWNd,cdood:'.  lNMMMMMMMMMMMMMMMMMMMMMMMWNO:.':ooc:;;;'. ;dc.  ..,:ldxOKNWNKkdddddddddc...;oOXNWMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMNl'okdoooooooooooooooooooddc.  .:oooxKXx;.;o;. ',..  .,ldoccd0NWMWNd'coooo:'.  lNMMMMMMMMMMMMMWWNNNNWWMMMWN0dc:;,....,:. 'dl. .;'...':ldx0NWNKkdoddddddl..'cx0NWMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMWx.,oooooooooooooooooooooooo;  .coooxKOc.,l,     ',  .;'......,oKNNo'coooo;'.  lNMMMMMMMMMMWWNK0kxddxkO0XNNWWWNXOc.  .,, .oo' .:ool;...,cox0NWNOdoooooddc..;okKNWMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMO. .coooooooooooooooooooooo:. .:oolx0k;.c;   .  ..  ..,:lol:.  ;OKl'collo;''  oWMMMMMMMMWWNKkdc;'...',;cdOKNWWNKo.   ,;..:o,   .,cddl'..,ldkXWNOoooooooo;.'cx0XWMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMK; .;oooo:'........':looloo:...:lllokd,...   .   .';cloollloc.  .;''cllll;'' .oWMMMMMMMWWX0dc'.     ......,;clol,    'l;....      .;odc. .cokXWKdlooooool'':d0XWMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMNo..:olll,.','''.   ,okdlll;.'.,llllll;.......,;clllllllllllll,.   .cllll,'' .oWMMMMMMWWXOo;.     ':clllc:;,'....    .,,.    ..     .;do' .loONXxlloooool,.;dOXWMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMK;.:llll'':,'.....;lkOolll'',..clccccllcccccllllcccccccclccodl'   .:cccc''' .dWMMMMMWWXOo;.    .:ooollloooooolcc:;''...     ..       .,. .;lx0Oollllllol'.;oOKNMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMW0;.:lclc...   .';ldxxoccl:.,,  ,cccccccccccccccccccccccccccd0x,   .:cccc''. .xMMMMMMWXOo;.  .':cllllllllllllllllllllllc::;,''............':llolllllllllc..,lkKNWMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM0;.,cccc:'...,;cloddoccccc'.:,  .;ccccccccccccccccccccc::::lOXx,.  .:::::''. .xMMMMMWN0d:.  .:lodocccccclllcccccccccccclllllllllcccccccccclllccccccccclc'  .ckKNWMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMNo';llcccccccccccllccccccc;.;c.   .,:::::::::::::::::::clodk0KOl'.,..::::;''. .kMMMMMWXOl'   ,co0XOl:cccccccccccccccccccccccccccccccccccccccccccccccccc:.  .'ckKNWMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMX:'lkdcc:::::::::::::::cc;.,l,      ':::::::::cclloodxkOOOkxdoc;.,l,.;:;:,.,. 'OMMMMMNKk:.   ,clONN0dc::::::ccccccccccccccccccccccccccccc:cccc:cc:::c:'.   .:d0XWMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMK:'okl:::::::::::::::::c,.'o:. .l,   .;:::loddxkkkkkxddolc:;;,..'lo, .;:;..:. ,0MMMMWNKx:..'..;clkKXX0kxddoollcc::::::::::::::::::::::::::::::::::c:'.   ..:dOXWWMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMNl':c:::::::::::::::::;..,oc.  cXO'    .,;:ccccccc::;;,,'......;o:'.  ....c:. ;KMMMMMNKx;.'l:..':cloodxxkkOOOOOkkkkxxdddooolllllccccccccc::::::::;'.    .'cx0XWWMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMWx..;::;;;;;;;;;;:::;'..co:.  ,0MWO,      ...............',;:cc:'.      'll.  lNMMMMWNKk:..:dl'...',,,;;::cccllooddddxxxkkkkkkkxxxdddooolc:::::,..    .':oOKNWMMMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMO.  .,;::::::::;,'...:ol'   'OWMMWK:.     .....'',,;::::;;'..      .   ...  .kMMMMMMWXOo,..'col:,............'',,,,,;;;::::::::::::::::;;,,'..     .':okKNWWMMMMMMMMM
MMMMMMMMMMMMMMMMMMMMMMWWWWWMMMMMMMMK;    ............,clc'.   ,OWMMMMMXo.     ..''''''...           .;xl.     .dNMMMMMMWNKkl,....,;;;;:::;;;,,''...........................        ..,cdOKNWWMMMMMMMMMMM
MMMMMMMMMMMMMMMMMMMMXklcccokKWMMMMMWd.     .....',:ccc;.    .cKWMMMMMMMNk;.                    ..,cx0XWNd'  .,xNMMMMMMMMWNXOxl;,...........',,;;;;;;;;;;;;,,,,,,'''''......     ..';lx0XNWMMMMMMMMMMMMMM
MMMMMMMMMMMMMMMMMMWO:,:llc;,,:dKWMMMXl.    ...'''''..     .;kNMMMMMMMMMMMNkl,.          ..';coxOKNWMMMMMWKkxOXWMMMMMMMMMMWNNXKOkdolc,..      .........................    ...',;:ldOKXNWMMMMMMMMMMMMMMMM
MMMMMMMMMMMMMMMMMWk;cOXNNNXOd;.'oKWMMNx,.                .lXWMMMMMMMMMMMMWX0OOkdoooodxxk0KXNWMMMMMMMMMMMMWWNXK0Okxxx0XNKOoclxKNNNXk:'.,:ccc;. .cooolc:;,......           .'codkkkO0XWWMMMMMMMMMMMMMMMMMM
MMMMMMMMMMMMMMMMMK:cKNNXXXXXK0d,.'dNMMWNk:..        ..,:'.,kWMMMMMMMMMMMNx;',;oONMMMMMMMMMMMMMMMMMMMWNKOdl:;,,'',.. .,;,';;. ;0WNx;;oOKXXNXKl. ,OXKK00Ox;,cc::,.  .,,,,....,o0Ol;,;:d0NWMMMMMMMMMMMMMMMM
MMMMMWX0kk0XWMMMWd:ONXKKKKKKKKKOl..:0WMMMNXOxl'.;lodxOKKk:..oXMMMMMMMMW0c,lkxc..cKWMMMMMMMMMMMMMWKklc:,,,:codxkOk;.,;coxOK0:  c0o,l0NWWNNNXXOc..,dKWWWWKcl0Oxxxc. .okkl':o; .:;;ldoc,';oKWMMMMMMMMMMMMMM
MMMMXd;,,,,,ckXMKloKXKKKXXXXK0KK0x, 'kWMMMMMWx;oXNXKKKKKK0l. cXMMMMMMW0::kKXNXx' ,kWMMMMMMMMMWKxc,,;:lxO0KKKKKKKd:d0KKKKKKk;. .;;xXWWNXXKKKKKK0o,.,xNMMKldXK000x'  lXXlc0Kk:. ;ONNXK0d;.'lKWWNNWMMMMMMMM
MMW0:,oO00kl'.;kkcxK00XNWWWNXXK000k; .dNMMMWO:oXXK0KKXKKKK0; .oWMMMMMXccOKKKXNNk, 'kWMMMMMWXkc,,cdOKKKKKKKKKKKKKocOKKKKKKk;,;. 'xXWNXNNXK000KXNN0l..cKWKldXK000O;  cN0coK0K0:'kXKKKKKK0x,.'dd;;lOWMMMMMM
MM0:cONNXKKKk; .,:k00KXXOdxOKXNXK00O: .oNMMXlcKXK0XNNNK00KXo. ,0MMMMWx:xKKKK0KXNk' 'OWMMWKd;,:d0NXKK000K0KK0KK00o:kKK000Kx,,. .lXWNXXXK0000000KKXKd. ,0KldXK0000o. ,0kcx00XKlcKXKKXXXKKKOl...;' .xWMMMMM
MXcc0XKK0KKKKk,  ;O00K0o'..,lxOXXK00O: .dNMO:xXK0XNNOdd00KXx. .xWMMMKcl00000K00XXd. ;0NOl,,lOXNXKK0000000000KKKKx,;dk000K0:.  ;0WNXXK00OO00000000KKd. ,xldK00000O: .llcO00X0clKX0KNNOddOK0x;:k:  :XMMMMM
Wx:kK00KXKK0K0c  'x000d'.'..;''o0XK00k; .xNdcOK0KNXd,.;k0KNk' .oWMMWk:kK00kloO00XKl. ,:,:dO0KKK0000000KKKXXXXXXX0; .:0K0KKl  .oXNXK00Oo,:xOO00000000o. .;o000OO00d. .'lO00XO:lKK0KN0:..,d00OOO:. '0MMMMM
Kcl000KXNNNK0O:...o0OOl.',..;' .,xKKOOx' 'xolO00NXd,,,.;xKNx,. cNMMNoc0K00o..lO00X0;  'd00000OO00K0000KXK0Oxdolc;.  :0KO0Xd. 'ONNK00k:''..',;lk00OO0O:  .lOOOOOOOOc  .o0O0Xk,cO00KNk;,' .lO00x:'.'0MMMMM
k:x000kdokKNXd,,..lOOOc:xOo::,.  .o00OOl. ,:lOOKN0:;:.  'dk:,. :XMMKcdK000c,'.oOOKXx. .d0OOO00KXNX0O0Oxll:'...'''.. cK0O0Xx'.:KNK0Ok:,c;. ... .oOOOOOx'  cOOOO0OOOx, .dOO0Xd.,k0O0XO;.   .:k0o;'.,0MMMMM
lcOOOd,..'l00c,, .oOOkllkOOxc,.   .cOOOk;  .lOOKXx;;.    ..':' cNMMOckKOKk;.. 'dOOXKl. ,k00KXNXKOxkOOOl.,,',,''...  cK0O0Xx'.lXXOOOc,:,        .:kOOOOc. 'xOk0K0kOOl.,xOk0Kl..oOOO00c   .  :d:,, ;XMMMMM
:oOOx;,c' .',';. 'dOkkllkOkkc'.    .:kOkl.  :kO0Ko,'..o:  .,, .xWMWxcO0OKx,...'lkO0XO, .,oOXXOd:.'oOOOl.,;..        lK0k0Xx'.oXKOOd;;,          .ckOkOd' .ckkOKOxkkx::xkk00c'.,xOOOOd' .c,  .':..lNMMMMM
:dOOd;,.    .;;. .okkkocxkkkl'. :d' .ckkd'  ,xkkOd'  'l:.     :KMNk;ckOkOkxxxxxkkkkOOxl:,.',;'.,''d0kOl.,;.  ':cldo,l0OkOKx..oX0kkl;,..:;        .okkkk:  ,xkOKdcdkkddxkkK0:'. ,xOkkko. ,o;  .' .kMMMMMM
:xkkd,. .;.  .  .,lkkkdlokkkd'  lN0; .lkx;  .lkkkxl;'',;;;'  .OWXo,:dkkkkkkkkkkkkkkkkkkkkxl;. .,.'x0kkl.';. 'OWWMMKclOkkOKd'.oK0kx:,' ;K0c.... .. ,xkkkc. .lkkKd.;xkkkxxkKO;'.  'okkkko,.':'    lNMMMMMM
:dkkx,  :K0:. .:kl:xxxdloxxxx:. .oko. :xxc.  ,dkxxkkxxkkkkx:..cOl,lkkxxxxxxxxkkkkkxxkkxxkkkkl.   .x0kkc...'.'OMMMMKclkxxOKd'.lK0xx:'..dWMNKKXO:',..lkxko.  :xk0d..cxxxxxkKx;'.   .:dkkkxo;..  .lXMMMMMMM
:dkxxc. ,KMNOxkOOc,okOkllxxxxdlc;,''':dxxl.   ;dxxxxxxxxxxxxc. .,okxxxxxxxxxxdddddxxxxxxxxxxd'   ,kOxxl'....'0MMMM0clkxxOKo'.c00xx:. .kMMMMMMM0:'..:xxko'  ,dk0d'.,oxxxxkKd,'.';.  .cdxxxxdc' .oKWMMMMMM
;dkxxd, .dWMMNx;'..'dK0c:dxxxxxkxxddxxxxkd'    'oxxxxxxxxxk0O:  :xxxxxxkko:''....'lxxO0kddxkl'.  ,kOxxl'.   ;XMMMMO:lxxxOKo'.;O0xxc. .OMMMMMMMNl...;dxxd,  'dk0d'.,;cxxxOKo'. .;,.   .:dxxxxxl'.,dXMMMMM
:oOxxxo, .okd:,:do' .ld,,dxxxxxxxxxxxxxk0d,.   .cxxxxxkOOO0X0:..lxxxxxx0kc'.,'''..;dxkKO:',;',,  'kOdxl'.  ,kWMMMMk:oxxxOKl'.'x0kxl. .xWMMMMMMWd...;dxxd,. .oxOx'.,''oxdO0c..c;....    .;oxxxxdc..;kNMMM
ccOkddxdc''',;oxxxc. ...'oxxxxxxxxdxxxOK0l,'...;dxdxk0XK0kxdc,',lxdxxdxOkc,..     .lxxOKo. .,:. .,xkdxc'. :KWMMMMMx:oxxxO0c'..l0kxd,  lNMMMMMMM0'  ,dxxd;. .oxOx,.,',oddOO:.cxdl'..,.    .'cddxxo;..lKMM
o,dOxdddddddddddddc.  .,'cxdddddddddkKX0o,,'  ,oddx0XKkl::'.';;'cxddddxOx:,.  .....;ddx0k,  .. .;:odddc'. oWMMMMMWx:oddx0O:'. ,kOxdc. ,0MMMMMMMWk;.;dddo,. .ldkk,.,,,oddOO;.cdddo;..,;.     'lddddc. :KM
x':OOdoddddddddddo;'.   .:ddddxkxdddxxdc',:. .:ddx0XOl'..,'',,. .:;:oddOd:,...xKX0:'oddO0l.   .oo:odddc'. lWMMMMMWd:oddx0k;.. .lkxdd;  cNMMMMMMMM0::dddl,. .ldxk;.,,,oddOk,.:dddddl,.'cc'    'odddx:. :X
K;.lOOdooooooooodl,,'   .:ddddocccodddc.':'  .lddOXO:',;',,.       ,oodOo;,...OMMWx':dox0x'  ,ONd;ododc'. lWMMMMW0c:ddodxd:.   'dxddo; .oNMMMMMMWd;ldddc,. .loxk; ',,lodOx,.,ooooodoc'.,lo:. .cdodkx' .d
Wd.'oO0xolllodxxd;,,..lx::oooo;...;oodo;.. ..;ood00c';:..',. .,,   ,oodx:,,...kMMMK:,looOO:  ;KWd;looo:'. lWMMMNx;,cooooooo;    ;ddodo;..lKWMMMNx;:oood:,' .lodxc....lodOd,..:oooooooo:'.,ll..coooOO;  ,
MK, 'lk00OOO00koc,,' ;KWd:oooo;.'..coooo,  ;c:ood0x,;;.   .. .''.  'lol:..,...kMMMWo':olx0o. .xNd;looo:'. oWMMKl':looooooooc.   .:oooooc'.'lddl;':ooool,,' 'looxl.  .:odOo,...:llllollolc,''':llloO0c. .
MWx. .;ldxxxoc,.',...oWWx;lool;..  ;ooool' ..;lldko''.  .  ..,:ll:..;:'.'..'..xMMMMO,,lloko.  lXd;llll:'..oWMKc,colllllllllc.    .;ooooooc;'''';looooo:,;. 'llldl.   'cxOc'.  .cllllllllllllllllldKO:.. 
MMNo.  .......'.''. .kMWx;clll,.. .,lllllc.  .cllol,....',:cllllll:. .,c;. ...kMMMMNc'cllc,'' :Ko;llcl;'..oWNo,clllllllllll:'..,,  ,lllllloollollllll:';,  .clloo'    .cl,''  .,;:cccccccccccccco0Kd,'. 
MMMXo.   ..',;;..'...kMMk:cllc,'..:;:lllll:. .;lcccccccclllccccccl:.  '.     ,KMMMMMx';c;.':, :Ko;cccc;'..dWKc;cccccccccccc,,'.ck;  .:lllllllllllllll,,:..,;;cclo,     ..':' .''..,:ccccccccclox0Oo,';..
MMMMNd.   ...   .'...xMMO::cc:,'.'o:;cccccc'  .:ccccccccccccccc:::cc.    ',.,kWMMMMMK:',.;c, .dXo;c:::,'..xW0c;cccc::lxdc,.':' lN0,   .;:cclllllcc:,,,'. ,xc,c:co:. .'. .,, .lc,'. .';:::cclodxxo:'':; .
MMMMMWKo,.   ..'..'..xWMK:;cc;,' ,kl,cccccc,.  .;::::::::::::ccldxOOo.   lKKXWMMMMMMNo,',;.  :KNo,::::''..kWKc,:,'...:lc:'';' .xWW0;    ..',,,,,'....'...xNo,::cxl. .ol.    ckc,'.    ..',;;;;'...,c;..l
MMMMMMMWX0kxxOK0; ...xWMXc.;;',' cXd';:::::,.   .,:::cllooddxxkkxdoc;',' lWMMMMMMMMMNo,'.. .lKMWd,;::;''..OMNl...,;;....''..  cXMMMXo.     ....',;;'''...OMk'':okl.  cKx'..lKKc.'.       ......,;:;.  ;K
MMMMMMMMMMMMMMMNl   'OMMWo. .,:..dWO,':::::,'.    .,:cloooollc:,'....;:..dWMMMMMMMMMWx..'..dNMMMk'.'..,;.'0MWd. ',.     .'...cKMMMMMWO:.    ......  .'...kMK, .::,'. ;KWX0KWMWo... .'.    ........  .cKW
MMMMMMMMMMMMMMMM0, .dNMMM0' .'. '0MXc.,:::,';. ..   ............',,;;,. ,0MMMMMMMMMMMO. . ,0MMMMK,  .,:. :XMM0,     ..   .'.'0MMMMMMMMN0o,.        ..'...kMNl  ..':, :XMMMMMMWx.  .lKkc'.         .;kNMM
MMMMMMMMMMMMMMMMWKk0NMMMMWx.   .dWMWx...''.;;..xk'    ...'',,,,,'...   .xWMMMMMMMMMMMK;   cXMMMMNd.  .  .xWMMWO:.,lkKk;.  . ,KMMMMMMMMMMWNKkxoooodkd'.'..xMMK:  .,,. lNMMMMMMM0;  'OMMWXOdlc:::cox0NMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMWOc,;xNMMMXc   .::. :XW0:.    ....        .'cOWMMMMMMMMMMMMWk,.;0WMMMMMXo.   .dNMMMMWNXNWMMWXk,   lNMMMMMMMMMMMMMMMMMMMMMX; ...kMMMKc.    ,0WMMMMMMMW0llOWMMMMMMMWWWWWMMMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMWNNWMMMMM0,  ..  'OWMMNOc,..    ...';cok0XWMMMMMMMMMMMMMMMWX0XWMMMMMMMW0kxxKWMMMMMMMMMMMMMMW0:'lKMMMMMMMMMMMMMMMMMMMMMMNl   ;KMMMMXd,.'l0WMMMMMMMMMMWWMMMMMMMMMMMMMMMMMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMWO;    ,OWMMMMMWN0OkkkOO0KNWWMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMNXWMMMMMMMMMMMMMMMMMMMMMMMM0:.,kWMMMMMWXKXWMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMXxooxXWMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMWXKXWMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMWMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM


 */

ini_set("display_errors", 0);
ini_set("display_startup_errors", 0);
error_reporting(32767);
$db = new SQLite3("./api/data/.bet3ads.db");
$res = $db->query("SELECT * \r\t\t\t\t  FROM movie_ads \r\t\t\t\t  WHERE id='" . $_GET["update"] . "'");
$row = $res->fetchArray();
if (isset($_POST["submit"])) {
    $db->exec("UPDATE movie_ads SET  \t\tredirect_link='" . $_POST["redirect_link"] . "', \r\t\t\t\t\t\t\t\timages='" . $_POST["images"] . "'\r\t\t\t\t\t\t  WHERE \r\t\t\t\t\t\t\t  \tid='" . $_POST["id"] . "'");
    $db->close();
    header("Location: movieads.php");
}
include "includes/header.php";
$id = $row["id"];
$title = $row["redirect_link"];
$url = $row["images"];
echo "\r<!-- [ Main Content ] start -->\r    <div class=\"pcoded-main-container\">\r        <div class=\"pcoded-wrapper\">\r            <div class=\"pcoded-content\">\r                <div class=\"pcoded-inner-content\">\r                    <div class=\"main-body\">\r                        <div class=\"page-wrapper\">\r                            <!-- [ Main Content ] start -->\r                            <div class=\"row\">\r                    <!-- Column -->\r                    <div class=\"col-lg-12\">\r                        <div class=\"card mb-4\">\r\t\t\t\t\t\t\t<div class=\"card-header bg-primary py-3\">\r                \t\t\t\t<h4 align=\"center\" class=\"m-0 font-weight-bold text-white\"><i class=\"fas fa-images\"  style=\"font-size:20px\">&nbsp;&nbsp;</i>Edit Advert</h4>\r                \t\t\t</div>\r                         <div class=\"card-body\">\r\t\t\t\t\t\t\t<form method=\"post\">\r                        <div  type=\"hidden\" class=\"form-group\">\r\t\t\t\t\t\t   <input type=\"hidden\" name=\"id\" value=\"";
echo $row["id"];
echo "\">\r                          <input type=\"hidden\" id=\"id\" class=\"form-control text-primary\" name=\"id\" value=\"";
echo $row["id"];
echo "\">\r                        </div>\r                         <div class=\"form-group\">\r                      </div>\r                                <div class=\"form-group\">\r                          <label class=\"bmd-label-floating\"><strong>Image Url</strong></label>\r                          <input type=\"images\" class=\"form-control text-primary\" name=\"images\" value=\"";
echo $row["images"];
echo "\" required/>\r                        </div>\r                         <div align=\"center\" class=\"form-group mb-3\">\r\t\t\t\t\t\t\t\t\t<br>\r\t\t\t\t\t\t\t\t\t\t<button class=\"btn btn-danger btn-icon-split\" name=\"submit\" type=\"submit\"><span class=\"icon text-white-50\"><i class=\"fas fa-save\"></i>&nbsp;&nbsp;</span><span class=\"text\"> Save Settings</span></button>\r                                </div>\r                            </form>\r                            </div>\r                        </div>\r                    </div>\r                    <!-- Column -->\r                </div>\r            </div>\r            <!-- ============================================================== -->\r            <!-- End Container fluid  -->\r            <!-- ============================================================== -->\r        </div>\r        <!-- ============================================================== -->\r        <!-- End Page wrapper  -->\r        <!-- ============================================================== -->\r    </div>\r";
include "includes/functions.php";

?>