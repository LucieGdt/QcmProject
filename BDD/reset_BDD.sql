
/* Script pour supprimer toute la BDD, a n'utiliser qu'en dernier recours */
DROP TABLE IF EXISTS Qcm_Question ;
DROP TABLE IF EXISTS Question_Reponse;
DROP TABLE IF EXISTS Statistiques;
DROP TABLE IF EXISTS Sous_Domaine;
DROP TABLE IF EXISTS Question;
DROP TABLE IF EXISTS Domaine;
DROP TABLE IF EXISTS Repondeur;
DROP TABLE IF EXISTS Reponse;
DROP TABLE IF EXISTS Qcm;
DROP TABLE IF EXISTS Questionneur;

DROP SEQUENCE IF EXISTS ID_DOMAINE;
DROP SEQUENCE IF EXISTS ID_SOUS_DOMAINE;
DROP SEQUENCE IF EXISTS ID_QUESTIONNEUR;
DROP SEQUENCE IF EXISTS ID_REPONDEUR;
DROP SEQUENCE IF EXISTS ID_QUESTION;
DROP SEQUENCE IF EXISTS ID_REPONSE;
DROP SEQUENCE IF EXISTS ID_QCM;