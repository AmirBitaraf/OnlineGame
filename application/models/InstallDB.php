<?php
/**
 * Install DB and add tables
 */
class installDB extends CI_Model
{

  function __construct()
  {
    parent::__construct();
    $this->load->dbforge();
    $this->load->library('table');
  }
  public function install()
  {
    $this->db->query('

    -- Table: country

    -- DROP TABLE country;

    CREATE TABLE IF NOT EXISTS country
    (
      id serial NOT NULL,
      name character varying(40) NOT NULL DEFAULT \'\'::character varying,      
      user_owner integer NOT NULL,
      CONSTRAINT country_pkey PRIMARY KEY (id)      
    )
    WITH (
      OIDS=FALSE
    );
    ALTER TABLE country
      OWNER TO ci;

      
        -- Table: users

    -- DROP TABLE users;

    CREATE TABLE IF NOT EXISTS users
    (
      id serial NOT NULL,
      firstname character varying(40) NOT NULL DEFAULT \'\'::character varying,
      lastname character varying(40) NOT NULL DEFAULT \'\'::character varying,
      email character varying(40) NOT NULL DEFAULT \'\'::character varying UNIQUE,
      username character varying(40) NOT NULL DEFAULT \'\'::character varying UNIQUE,
      password character varying(40) NOT NULL,
      country_id integer NOT NULL,
      role character varying(40) NOT NULL DEFAULT \'king\'::character varying,
      CONSTRAINT users_pkey PRIMARY KEY (id),
      CONSTRAINT users_country_id_fkey FOREIGN KEY (country_id)
          REFERENCES country (id) MATCH SIMPLE
          ON UPDATE NO ACTION ON DELETE NO ACTION
      
    )
    WITH (
    OIDS=FALSE
    );
    ALTER TABLE users
    OWNER TO ci;
      
      
      

    -- Table: messages

    -- DROP TABLE messages;

    CREATE TABLE IF NOT EXISTS messages
    (
      id  serial NOT NULL,
      text text NOT NULL,
      country_id integer NOT NULL,
      user_id integer NOT NULL,
      CONSTRAINT messages_pkey PRIMARY KEY (id),
      CONSTRAINT messages_country_id_fkey FOREIGN KEY (country_id)
          REFERENCES country (id) MATCH SIMPLE
          ON UPDATE NO ACTION ON DELETE NO ACTION,
      CONSTRAINT messages_users_id_fkey FOREIGN KEY (user_id)
          REFERENCES users (id) MATCH SIMPLE
          ON UPDATE NO ACTION ON DELETE NO ACTION
    )
    WITH (
      OIDS=FALSE
    );
    ALTER TABLE messages
      OWNER TO ci;


    -- Table: vote

    -- DROP TABLE vote;

    CREATE TABLE IF NOT EXISTS vote
    (
      id serial NOT NULL,
      message_id integer NOT NULL,
      user_id integer NOT NULL,
      CONSTRAINT vote_pkey PRIMARY KEY (id),
      CONSTRAINT vote_message_id_fkey FOREIGN KEY (message_id)
          REFERENCES messages (id) MATCH SIMPLE
          ON UPDATE NO ACTION ON DELETE NO ACTION,
      CONSTRAINT vote_user_id_fkey FOREIGN KEY (user_id)
          REFERENCES users (id) MATCH SIMPLE
          ON UPDATE NO ACTION ON DELETE NO ACTION
    )
    WITH (
      OIDS=FALSE
    );
    ALTER TABLE vote
      OWNER TO ci;


    -- Function: count_message_people_vote(integer, integer)

    -- DROP FUNCTION count_message_people_vote(integer, integer);

    CREATE OR REPLACE FUNCTION count_message_people_vote(
        people integer,
        message integer)
      RETURNS integer AS
    $BODY$

    declare
    	num integer;
    BEGIN
    	SELECT COUNT(*) INTO num FROM VOTE WHERE VOTE.MESSAGE_ID=message AND VOTE.PEOPLE_ID=people;
    	RETURN num;
    END;
    $BODY$
      LANGUAGE plpgsql VOLATILE
      COST 100;
    ALTER FUNCTION count_message_people_vote(integer, integer)
      OWNER TO ci;


    -- Function: find_people_by_name(character varying)

    -- DROP FUNCTION find_people_by_name(character varying);

    CREATE OR REPLACE FUNCTION find_people_by_name(peo_name character varying)
      RETURNS integer AS
    $BODY$
    declare
    	people_id integer;
    BEGIN
    	SELECT PEOPLE.ID INTO people_id FROM PUBLIC.PEOPLE WHERE PEOPLE.P_NAME=peo_name;
    	RETURN people_id;
    END;
    $BODY$
      LANGUAGE plpgsql VOLATILE
      COST 100;
    ALTER FUNCTION find_people_by_name(character varying)
      OWNER TO ci;


      -- Function: number_of_users()

      -- DROP FUNCTION number_of_users();

      CREATE OR REPLACE FUNCTION number_of_users()
        RETURNS integer AS
      $BODY$
      declare
      	total integer;
      BEGIN
         SELECT count(*) into total FROM USERS;
         RETURN total;
      END;
      $BODY$
        LANGUAGE plpgsql VOLATILE
        COST 100;
      ALTER FUNCTION number_of_users()
        OWNER TO ci;


      -- Function: totalrecords()

      -- DROP FUNCTION totalrecords();

      CREATE OR REPLACE FUNCTION totalrecords()
        RETURNS integer AS
      $BODY$
      declare
      	total integer;
      BEGIN
         SELECT count(*) into total FROM USERS;
         RETURN total;
      END;
      $BODY$
        LANGUAGE plpgsql VOLATILE
        COST 100;
      ALTER FUNCTION totalrecords()
        OWNER TO ci;

    -- Function: count_message_people_vote(integer, integer)

    -- DROP FUNCTION count_message_people_vote(integer, integer);

    CREATE OR REPLACE FUNCTION count_message_people_vote(
        people integer,
        message integer)
      RETURNS integer AS
    $BODY$

    declare
    	num integer;
    BEGIN
    	SELECT COUNT(*) INTO num FROM VOTE WHERE VOTE.MESSAGE_ID=message AND VOTE.PEOPLE_ID=people;
    	RETURN num;
    END;
    $BODY$
      LANGUAGE plpgsql VOLATILE
      COST 100;
    ALTER FUNCTION count_message_people_vote(integer, integer)
      OWNER TO ci;

    -- Function: totalrecords()

    -- DROP FUNCTION totalrecords();

    CREATE OR REPLACE FUNCTION totalrecords()
      RETURNS integer AS
    $BODY$
    declare
    	total integer;
    BEGIN
       SELECT count(*) into total FROM USERS;
       RETURN total;
    END;
    $BODY$
      LANGUAGE plpgsql VOLATILE
      COST 100;
    ALTER FUNCTION totalrecords()
      OWNER TO ci;

    CREATE OR REPLACE FUNCTION get_messages_of_people(p_id INT)
    RETURNS VARCHAR AS $message$
    declare
    	message VARCHAR;
    BEGIN
    	SELECT  MESSAGES.me_text INTO message FROM PUBLIC.MESSAGES WHERE MESSAGES.id=p_id;
    	RETURN message;

    END;
    $message$ LANGUAGE plpgsql;
    
    
    CREATE OR REPLACE FUNCTION allMessages(country_id integer) RETURNS
    TABLE(id integer, firstname character varying, lastname character varying,
    role character varying, me_text text, votes bigint
    ) AS $$
    
    BEGIN         
         RETURN QUERY
             SELECT messages.id, users.firstname, users.lastname,users.role,
             messages.text as me_text, votes.votes
             FROM messages LEFT JOIN
             (SELECT vote.id AS mid,COUNT(*) AS votes FROM vote GROUP BY vote.id) AS votes
             ON messages.id = votes.mid
             INNER JOIN users ON messages.user_id=users.id;
    END;
    $$ LANGUAGE plpgsql;
    
    
    

    ');
  }
}


 ?>
