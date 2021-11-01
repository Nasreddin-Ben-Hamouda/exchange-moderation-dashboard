<?php
/*
  Ce ficher contient toutes les requetes SQL utilisées dans ce projet pour récupérer les données adéquates 
*/
return [
	"GET_LAST2DAYS_COUNTS_QUERY" => "
	     SELECT 
		 
			(SELECT COUNT(DISTINCT ps.post_id) FROM post_signals as ps JOIN posts as p 
			ON ps.post_id = p.id WHERE DATE(ps.created_at) BETWEEN 
			':start_date' AND ':end_date') as NBR_SIGNALED_POSTS, 
		 
			(SELECT COUNT(DISTINCT us.signaled_id) FROM user_signals as us JOIN blog_users as bu 
			ON us.signaled_id = bu.id WHERE DATE(us.created_at) BETWEEN 
			':start_date' AND ':end_date') as NBR_SIGNALED_PROFILES,
			
			(SELECT COUNT(*) FROM topics as t where DATE(t.created_at) 
			BETWEEN ':start_date' AND ':end_date') as NBR_CREATED_TOPICS,
			
			(SELECT COUNT(*) FROM sessions as s where DATE(s.opened_on) 
			BETWEEN ':start_date' AND ':end_date') as NBR_OPENED_SESSIONS,

			(SELECT COUNT(DISTINCT cs.comment_id) FROM comment_signals as cs where            		DATE(cs.created_at)  BETWEEN 
			':start_date' AND ':end_date') as NBR_SIGNALED_COMMENTS 
	",


	"GET_LAST7DAYS_GROUP1_COUNTS_QUERY" => "
         SELECT DATE(created_at) AS DAY,COUNT(*) as NBR_IN_THE_DAY, 1 SET_ORDER FROM post_signals 
		 WHERE DATE(created_at) BETWEEN ':start_date' AND ':end_date' GROUP BY DATE(created_at) 

         UNION ALL 

         SELECT DATE(created_at) AS DAY,COUNT(*) as NBR_IN_THE_DAY,2 SET_ORDER FROM user_signals 
		 WHERE DATE(created_at) BETWEEN ':start_date' AND ':end_date' GROUP BY DATE(created_at) 

		 UNION ALL

		 SELECT DATE(wv.voted_on) as DAY,COUNT(*) as NBR_IN_THE_DAY,3 SET_ORDER
		 FROM weight_votes as wv INNER JOIN posts as p ON wv.post_id = p.id 
		 WHERE DATE(wv.voted_on) 
		 BETWEEN ':start_date' AND ':end_date' 
		 GROUP BY wv.post_id,DATE(voted_on) 
		 HAVING NBR_IN_THE_DAY >=100

		 UNION ALL

         SELECT DATE(created_at) AS DAY,COUNT(*) as NBR_IN_THE_DAY,4 SET_ORDER FROM comment_signals 
		 WHERE DATE(created_at) BETWEEN ':start_date' AND ':end_date' GROUP BY DATE(created_at) 		 

         ORDER BY SET_ORDER,DAY
	",


	"GET_LAST7DAYS_GROUP2_COUNTS_QUERY" => "
	  SELECT 

	   (SELECT COUNT(*) FROM comments c WHERE DATE(c.created_at) BETWEEN ':start_date' AND ':end_date') 
	   AS C_I1, 
	
	   (SELECT COUNT(*) FROM post_signals ps WHERE DATE(ps.created_at) BETWEEN ':start_date' AND ':end_date') 
	   AS C_I2,
	
	   (SELECT COUNT(*) FROM user_signals us WHERE DATE(us.created_at) BETWEEN ':start_date' AND ':end_date') 
	   AS C_I3,

	   (SELECT COUNT(*) FROM comment_signals cs WHERE DATE(cs.created_at) BETWEEN ':start_date' AND ':end_date') 
	   AS C_I4,

	   (SELECT COUNT(*) FROM posts p WHERE DATE(p.created_at) BETWEEN ':start_date' AND ':end_date') 
	   AS C_I5, 
	
	   (SELECT COUNT(*) FROM topics t WHERE DATE(t.created_at) BETWEEN ':start_date' AND ':end_date') 
	   AS C_I6,
	
	   (SELECT COUNT(*) FROM weight_votes wv WHERE DATE(wv.voted_on) BETWEEN ':start_date' AND ':end_date') 
	   AS C_I7,
	
	   (SELECT COUNT(DISTINCT p.user_id) FROM posts p WHERE DATE(p.created_at) BETWEEN ':start_date' AND ':end_date') 
	   AS C_P1,
	
	   (SELECT COUNT(DISTINCT c.user_id) FROM comments c WHERE DATE(c.created_at) BETWEEN ':start_date' AND ':end_date') 
	   AS C_P2,
	
	   (SELECT COUNT(DISTINCT ps.user_id) FROM post_signals ps WHERE DATE(ps.created_at) BETWEEN ':start_date' AND ':end_date') 
	   AS C_P3,

	   (SELECT COUNT(DISTINCT cs.user_id) FROM comment_signals  cs WHERE DATE(cs.created_at) BETWEEN ':start_date' AND ':end_date') 
	   AS C_P4,
	
	   (SELECT COUNT(DISTINCT us.user_id) FROM user_signals us WHERE DATE(us.created_at) BETWEEN ':start_date' AND ':end_date') 
	   AS C_P5,
	
	   (SELECT COUNT(DISTINCT t.created_by) FROM topics t WHERE DATE(t.created_at) BETWEEN ':start_date' AND ':end_date') 
	   AS C_P6,
	
	   (SELECT COUNT(DISTINCT wv.user_id) FROM weight_votes wv WHERE DATE(wv.voted_on) BETWEEN ':start_date' AND ':end_date') 
	   AS C_P7;
	",



	"GET_LAST7DAYS_PER_DAY_GROUP2_COUNTS_QUERY" => "
	  SELECT 

	   (SELECT COUNT(*) FROM comments c WHERE DATE(c.created_at) =':search_date') 
	   AS C_I1, 
	
	   (SELECT COUNT(*) FROM post_signals ps WHERE DATE(ps.created_at) =':search_date') 
	   AS C_I2,
	
	   (SELECT COUNT(*) FROM user_signals us WHERE DATE(us.created_at) =':search_date') 
	   AS C_I3,

	   (SELECT COUNT(*) FROM comment_signals cs WHERE DATE(cs.created_at) =':search_date') 
	   AS C_I4,
	
	   (SELECT COUNT(*) FROM posts p WHERE DATE(p.created_at) =':search_date') 
	   AS C_I5, 
	
	   (SELECT COUNT(*) FROM topics t WHERE DATE(t.created_at) =':search_date') 
	   AS C_I6,
	
	   (SELECT COUNT(*) FROM weight_votes wv WHERE DATE(wv.voted_on) =':search_date') 
	   AS C_I7,
	
	   (SELECT COUNT(DISTINCT p.user_id) FROM posts p WHERE DATE(p.created_at) =':search_date') 
	   AS C_P1,
	
	   (SELECT COUNT(DISTINCT c.user_id) FROM comments c WHERE DATE(c.created_at) =':search_date') 
	   AS C_P2,
	
	   (SELECT COUNT(DISTINCT ps.user_id) FROM post_signals ps WHERE DATE(ps.created_at) =':search_date') 
	   AS C_P3,

	   (SELECT COUNT(DISTINCT cs.user_id) FROM comment_signals cs WHERE DATE(cs.created_at) =':search_date') 
	   AS C_P4,
	
	   (SELECT COUNT(DISTINCT us.user_id) FROM user_signals us WHERE DATE(us.created_at) =':search_date') 
	   AS C_P5,
	
	   (SELECT COUNT(DISTINCT t.created_by) FROM topics t WHERE DATE(t.created_at) =':search_date') 
	   AS C_P6,
	
	   (SELECT COUNT(DISTINCT wv.user_id) FROM weight_votes wv WHERE DATE(wv.voted_on) =':search_date') 
	   AS C_P7;	
	",


	"GET_LAST_N_SIGNALED_POSTS_AND_PROFILES_AND_COMMENTS" => "
	    SELECT p.id as C1,p.title as C2,SUBSTRING(p.content FROM 1 FOR 10) as C3,
		CONCAT(bu.firstname,' ',bu.lastname ) AS C4,bu.id AS C5 ,
		tmpTab.last_signal_date as LAST_SIGNAL_AT ,
		tmpTab.nbr_of_signals as NBR_OF_SIGNALS,
		1 SET_ORDER FROM posts p INNER JOIN 
		(SELECT ps.post_id ,MAX(ps.created_at) AS last_signal_date,
		  COUNT(*) AS nbr_of_signals
		  FROM post_signals ps 
		  GROUP BY ps.post_id 
		  ORDER BY last_signal_date 
		  DESC LIMIT :N
		) tmpTab 
		ON p.id = tmpTab.post_id INNER JOIN blog_users bu 
		ON p.user_id = bu.id 
		
		   UNION ALL 
		
		SELECT bu.id as C1,bu.firstname as C2,bu.lastname as C3,
		bu.email as C4,bu.birthdate as C5,tmpTab.last_signal_date as LAST_SIGNAL_AT,
		tmpTab.nbr_of_signals as NBR_OF_SIGNALS,2 SET_ORDER FROM blog_users bu 
		INNER JOIN 
		(SELECT us.signaled_id ,MAX(us.created_at) AS last_signal_date,
		  COUNT(*) AS nbr_of_signals FROM user_signals us 
		  GROUP BY us.signaled_id 
		  ORDER BY last_signal_date 
		  DESC LIMIT :N
		) tmpTab ON bu.id = tmpTab.signaled_id 

		   UNION ALL 

	    SELECT c.id as C1,SUBSTRING(c.content FROM 1 FOR 10) as C2,
		c.post_id AS C3,CONCAT(bu.firstname,' ',bu.lastname ) AS C4,bu.id AS C5,
		tmpTab.last_signal_date as LAST_SIGNAL_AT ,
		tmpTab.nbr_of_signals as NBR_OF_SIGNALS,
		3 SET_ORDER FROM comments c INNER JOIN 
		(SELECT cs.comment_id ,MAX(cs.created_at) AS last_signal_date,
		  COUNT(*) AS nbr_of_signals
		  FROM comment_signals cs 
		  GROUP BY cs.comment_id 
		  ORDER BY last_signal_date 
		  DESC LIMIT :N
		) tmpTab 
		ON c.id = tmpTab.comment_id INNER JOIN blog_users bu 
		ON c.user_id = bu.id 

		
		ORDER BY SET_ORDER ASC,LAST_SIGNAL_AT DESC
	",


	"GET_BLACKLISTED_PROFILES"=> "
	   SELECT bu.*,COUNT(*) as nbr_of_signals FROM blog_users bu 
	   INNER JOIN user_signals us ON bu.id = us.signaled_id AND DATE(us.created_at) 
	   BETWEEN '2021-07-15' AND '2021-07-28' 
	   GROUP BY bu.id HAVING nbr_of_signals >= 1
	" 
];
?>
