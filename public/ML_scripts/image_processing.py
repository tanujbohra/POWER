#!/usr/bin/python
# -*- coding: iso-8859-15 -*-

#!/usr/local/bin/python
# latin-1
#!/usr/local/bin/python
# -*- coding: utf-42 -*-

#!/usr/bin/env python

import pymysql.cursors
import nltk
from nltk.corpus import stopwords
from nltk.tokenize import sent_tokenize, word_tokenize
from sightengine.client import SightengineClient
connection = pymysql.connect(host='localhost',
                             user='',
                             password='',
                             db='',
                             charset='utf8mb4',
                             cursorclass=pymysql.cursors.DictCursor)


try:


    with connection.cursor() as cursor:
        bad_words = ["4r5e","50 yard cunt punt†††","5h1t","5hit","a_s_s","a2m","a55","adult","amateur","anal","anal impaler†††","anal leakage†††","anilingus","anus","ar5e","arrse","arse","arsehole","ass","ass fuck†††","asses","assfucker","ass-fucker",
        "asshole","asshole","assholes","assmucus†††","assmunch","asswhole","autoerotic","b!tch","b00bs","b17ch","b1tch","ballbag","ballsack","bang (ones) box†††","bangbros","bareback","bastard","beastial","beastiality","beef curtain†††","bellend","bestial","bestiality","bi+ch","biatch",
        "bimbos","birdlock","bitch","bitch tit†††","bitcher","bitchers","bitches","bitchin","bitching","bloody","blow job","blow me†††","blow mud†††","blowjob","blowjobs","blue waffle†††","blumpkin†††","boiolas","bollock","bollok","boner","boob","boobs","booobs","boooobs",
        "booooobs","booooooobs","breasts","buceta","bugger","bum","bunny fucker","bust a load†††","busty","butt","butt fuck†††","butthole","buttmuch","buttplug","c0ck","c0cksucker","carpet muncher","carpetmuncher","cawk","chink","choade†††","chota bags†††","cipa","cl1t","clit",
        "clit licker†††","clitoris","clits","clitty litter†††","clusterfuck","cnut","cock","cock pocket†††","cock snot†††","cockface","cockhead","cockmunch","cockmuncher","cocks","cocksuck ","cocksucked ","cocksucker","cock-sucker","cocksucking","cocksucks ","cocksuka","cocksukka","cok","cokmuncher","coksucka",
        "coon","cop some wood†††","cornhole†††","corp whore†††","cox","cum","cum chugger†††","cum dumpster†††","cum freak†††","cum guzzler†††","cumdump†††","cummer","cumming","cums","cumshot","cunilingus","cunillingus","cunnilingus","cunt","cunt hair†††","cuntbag†††","cuntlick ","cuntlicker ","cuntlicking ","cunts",
        "cuntsicle†††","cunt-struck†††","cut rope†††","cyalis","cyberfuc","cyberfuck ","cyberfucked ","cyberfucker","cyberfuckers","cyberfucking ","d1ck","damn","dick","dick hole†††","dick shy†††","dickhead","dildo","dildos","dink","dinks","dirsa","dirty Sanchez†††","dlck","dog-fucker","doggie style",
        "doggiestyle","doggin","dogging","donkeyribber","doosh","duche","dyke","eat a dick†††","eat hair pie†††","ejaculate","ejaculated","ejaculates ","ejaculating ","ejaculatings","ejaculation","ejakulate","erotic","f u c k","f u c k e r","f_u_c_k","f4nny","facial†††","fag","fagging","faggitt",
        "faggot","faggs","fagot","fagots","fags","fanny","fannyflaps","fannyfucker","fanyy","fatass","fcuk","fcuker","fcuking","feck","fecker","felching","fellate","fellatio","fingerfuck ","fingerfucked ","fingerfucker ","fingerfuckers","fingerfucking ","fingerfucks ","fist fuck†††",
        "fistfuck","fistfucked ","fistfucker ","fistfuckers ","fistfucking ","fistfuckings ","fistfucks ","flange","flog the log†††","fook","fooker","fuck hole†††","fuck puppet†††","fuck trophy†††","fuck yo mama†††","fuck†††","fucka","fuck-ass†††","fuck-bitch†††","fucked","fucker","fuckers","fuckhead","fuckheads","fuckin",
        "fucking","fuckings","fuckingshitmotherfucker","fuckme ","fuckmeat†††","fucks","fucktoy†††","fuckwhit","fuckwit","fudge packer","fudgepacker","fuk","fuker","fukker","fukkin","fuks","fukwhit","fukwit","fux","fux0r","gangbang","gangbang†††","gang-bang†††","gangbanged ","gangbangs ",
        "gassy ass†††","gaylord","gaysex","goatse","god","god damn","god-dam","goddamn","goddamned","god-damned","ham flap†††","hardcoresex ","hell","heshe","hoar","hoare","hoer","homo","homoerotic","hore","horniest","horny","hotsex","how to kill","how to murdep",
        "jackoff","jack-off ","jap","jerk","jerk-off ","jism","jiz ","jizm ","jizz","kawk","kinky Jesus†††","knob","knob end","knobead","knobed","knobend","knobend","knobhead","knobjocky","knobjokey","kock","kondum","kondums","kum","kummer",
        "kumming","kums","kunilingus","kwif†††","l3i+ch","l3itch","labia","LEN","lmao","lmfao","lmfao","lust","lusting","m0f0","m0fo","m45terbate","ma5terb8","ma5terbate","mafugly†††","masochist","masterb8","masterbat*","masterbat3","masterbate","master-bate",
        "masterbation","masterbations","masturbate","mof0","mofo","mo-fo","mothafuck","mothafucka","mothafuckas","mothafuckaz","mothafucked ","mothafucker","mothafuckers","mothafuckin","mothafucking ","mothafuckings","mothafucks","motherfucker","mother fucker†††","motherfuck","motherfucked","motherfucker","motherfuckers","motherfuckin","motherfucking",
        "motherfuckings","motherfuckka","motherfucks","muff","muff puff†††","mutha","muthafecker","muthafuckker","muther","mutherfucker","n1gga","n1gger","nazi","need the dick†††","nigg3r","nigg4h","nigga","niggah","niggas","niggaz","nigger","niggers ","nob","nob jokey","nobhead",
        "nobjocky","nobjokey","numbnuts","nut butter†††","nutsack","omg","orgasim ","orgasims ","orgasm","orgasms ","p0rn","pawn","pecker","penis","penisfucker","phonesex","phuck","phuk","phuked","phuking","phukked","phukking","phuks","phuq","pigfucker",
        "pimpis","piss","pissed","pisser","pissers","pisses ","pissflaps","pissin ","pissing","pissoff ","poop","porn","porno","pornography","pornos","prick","pricks ","pron","pube","pusse","pussi","pussies","pussy","pussy fart†††","pussy palace†††",
        "pussys ","queaf†††","queer","rectum","retard","rimjaw","rimming","s hit","s.o.b.","s_h_i_t","sadism","sadist","sandbar†††","sausage queen†††","schlong","screwing","scroat","scrote","scrotum","semen","sex","sh!+","sh!t","sh1t","shag",
        "shagger","shaggin","shagging","shemale","shi+","shit","shit fucker†††","shitdick","shite","shited","shitey","shitfuck","shitfull","shithead","shiting","shitings","shits","shitted","shitter","shitters ","shitting","shittings","shitty ","skank","slope†††",
        "slut","slut bucket†††","sluts","smegma","smut","snatch","son-of-a-bitch","spac","spunk","t1tt1e5","t1tties","teets","teez","testical","testicle","tit","tit wank†††","titfuck","tits","titt","tittie5","tittiefucker","titties","tittyfuck","tittywank",
        "titwank","tosser","turd","tw4t","twat","twathead","twatty","twunt","twunter","v14gra","v1gra","vagina","viagra","vulva","w00se","wang","wank","wanker","wanky","whoar","whore","willies","willy","wtf","fuck",
        "sexy","nude","xxx","xrated"]
    #     # Read a all records
        sql = "SELECT project_short_description, project_description,project_image,project_id,project_score FROM `project`"
        cursor.execute(sql)
        result = cursor.fetchall()
        for row in result:
              img=row["project_image"]
              project_id=row["project_id"]
              project_score=row["project_score"]
              project_description=row["project_description"]
              project_short_description=row["project_short_description"]
              project_score=0
              score=0
              list1=word_tokenize(project_short_description)
              list2=word_tokenize(project_description)
              for i in list1:
                  if i in bad_words:
                     score = score +1
              for i in list2:
                  if i in bad_words:
                     score = score +1
              #print(img)
              if score>=20:
                score=20

              project_score=(score*100)/20

              url="/Applications/XAMPP/xamppfiles/htdocs/POWER/public/UploadsImages/"+img
              client = SightengineClient("780030986", "SOME_KEY")
              output1 = client.check('wad').set_file(url)
              output2 = client.check('nudity').set_file(url)
              weapon = output1['weapon']
              alcohol = output1['alcohol']

              drugs = output1['drugs']


              nudes_raw = output2['nudity']['raw']
              nudes_partial = output2['nudity']['partial']
              nudes_safe = output2['nudity']['safe']


              #calculate score based on the VALUES
              img_score = ((weapon + alcohol + drugs)*100 + (nudes_raw + nudes_partial)*100)/2
              project_score=(project_score+img_score)/2
              print(project_score)

              sql = "Update `project` set project_score = %s where project_id = %s"
              cursor.execute(sql,(project_score,project_id))
              connection.commit()










except Exception as e:

    print("Exeception occured:{}".format(e))
finally:
    connection.close()
