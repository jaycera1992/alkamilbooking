=======================================================================
= SPECIALTIES ELASTIC SEARCH
=======================================================================

   PUT /specialties
{
    "mappings" : {
        "info" : {
            "properties" : {
                "specialty_id" : { "type" : "text" },
                "en_specialty" : { "type" : "text" },
                "date_created": { "type": "date", "format": "yyyy-MM-dd HH:mm:ss" },
                "date_updated": { "type": "date", "format": "yyyy-MM-dd HH:mm:ss" },
                "is_deleted": { "type": "integer" },
                "created_by_user_id": { "type": "text" },
                "approved_by_user_id": { "type": "text" },
                "is_approved": { "type": "integer" }
            }
        },
        "honors" : {
        "_parent": {
            "type": "info"
          },
          "properties": {
             "id": {
               "type" : "long"
             },
             "text": {
               "type": "text" 
             }
          }
        },
        "hobbies" : {
        "_parent": {
            "type": "info" 
          },
          "properties": {
             "id": {
               "type" : "long"
             },
             "text": {
               "type": "text" 
             }
          } 
        },
        "training_certificates" : {
        "_parent": {
            "type": "info"
          },
          "properties": {
             "id": {
               "type" : "long"
             }
          }
        },
        "jobs" : {
        "_parent": {
            "type": "info"
          },
          "properties": {
             "id": {
               "type" : "long"
             }
          }
        },
        "industries" : {
        "_parent": {
            "type": "info"
          },
          "properties": {
             "id": {
               "type" : "long"
             }
          }
        }
    }
}

PUT /specialties/_mappings/jobs
{
  "_parent": {
      "type": "info" 
    },
    "_routing": 
    {
      "required": true
    },
    "properties": {
        "job_id": { "type": "text" },
        "job": { "type": "text" }
    }
}


PUT /specialties/_mappings/industries
{
  "_parent": {
      "type": "info" 
    },
    "_routing": 
    {
      "required": true
    },
    "properties": {
        "industry_id": { "type": "text" },
        "industry": { "type": "text" }
    }
}


PUT /specialties/_mappings/training_certificates
{
  "_parent": {
      "type": "info" 
    },
    "_routing": 
    {
      "required": true
    },
    "properties": {
        "training_certificate_id: { "type": "text" },
        "training_certificate": { "type": "text" }
    }
}

PUT /specialties/_mappings/honors
{
  "_parent": {
      "type": "info" 
    },
    "_routing": 
    {
      "required": true
    },
    "properties": {
        "honor_id": { "type": "text" },
        "honor": { "type": "text" }
    }
}

PUT /specialties/_mappings/hobbies
{
  "_parent": {
      "type": "info" 
    },
    "_routing": 
    {
      "required": true
    },
    "properties": {
        "hobby_id": { "type": "text" },
        "hobby": { "type": "text" }
    }
}

PUT /honors
{
    "mappings" : {
        "info" : {
            "properties" : {
                "honor_id" : { "type" : "text" },
                "en_honor" : { "type" : "text" },
                "date_created": { "type": "date", "format": "yyyy-MM-dd HH:mm:ss" },
                "date_updated": { "type": "date", "format": "yyyy-MM-dd HH:mm:ss" },
                "is_deleted": { "type": "integer" },
                "created_by_user_id": { "type": "text" },
                "approved_by_user_id": { "type": "text" },
                "is_approved": { "type": "integer" }
            }
        },
        "specialties" : {
        "_parent": {
            "type": "info"
          },
          "properties": {
             "id": {
               "type" : "long"
             },
             "text": {
               "type": "text" 
             }
          }
        },
        "hobbies" : {
        "_parent": {
            "type": "info" 
          },
          "properties": {
             "id": {
               "type" : "long"
             },
             "text": {
               "type": "text" 
             }
          } 
        }
    }
}

PUT /honors/_mappings/specialties
{
  "_parent": {
      "type": "info" 
    },
    "_routing": 
    {
      "required": true
    },
    "properties": {
        "specialty_id": { "type": "text" },
        "specialty": { "type": "text" }
    }
}

PUT /honors/_mappings/hobbies
{
  "_parent": {
      "type": "info" 
    },
    "_routing": 
    {
      "required": true
    },
    "properties": {
        "hobby_id": { "type": "text" },
        "hobby": { "type": "text" }
    }
}

PUT /hobbies
{
    "mappings" : {
        "info" : {
            "properties" : {
                "hobby_id" : { "type" : "text" },
                "en_hobby" : { "type" : "text" },
                "date_created": { "type": "date", "format": "yyyy-MM-dd HH:mm:ss" },
                "date_updated": { "type": "date", "format": "yyyy-MM-dd HH:mm:ss" },
                "is_deleted": { "type": "integer" },
                "created_by_user_id": { "type": "text" },
                "approved_by_user_id": { "type": "text" },
                "is_approved": { "type": "integer" }
            }
        },
        "specialties" : {
        "_parent": {
            "type": "info"
          },
          "properties": {
             "id": {
               "type" : "long"
             },
             "text": {
               "type": "text" 
             }
          }
        },
        "honors" : {
        "_parent": {
            "type": "info" 
          },
          "properties": {
             "id": {
               "type" : "long"
             },
             "text": {
               "type": "text" 
             }
          } 
        }
    }
}

PUT /hobbies/_mappings/specialties
{
  "_parent": {
      "type": "info" 
    },
    "_routing": 
    {
      "required": true
    },
    "properties": {
        "specialty_id": { "type": "text" },
        "specialty": { "type": "text" }
    }
}

PUT /hobbies/_mappings/honors
{
  "_parent": {
      "type": "info" 
    },
    "_routing": 
    {
      "required": true
    },
    "properties": {
        "honor_id": { "type": "text" },
        "honor": { "type": "text" }
    }
}


=======================================================================
= TRAINING CERTIFICATE ELASTIC SEARCH
=======================================================================

PUT /training_certificates
{
    "mappings" : {
        "info" : {
            "properties" : {
                "training_certificate_id" : { "type" : "text" },
                "en_training_certificate" : { "type" : "text" },
                "date_created": { "type": "date", "format": "yyyy-MM-dd HH:mm:ss" },
                "date_updated": { "type": "date", "format": "yyyy-MM-dd HH:mm:ss" },
                "is_deleted": { "type": "integer" },
                "created_by_user_id": { "type": "text" },
                "approved_by_user_id": { "type": "text" },
                "is_approved": { "type": "integer" }
            }
        },
        "industries" : {
        "_parent": {
            "type": "info"
          },
          "properties": {
             "id": {
               "type" : "long"
             },
             "text": {
               "type": "text" 
             }
          }
        },
        "specialties" : {
        "_parent": {
            "type": "info" 
          },
          "properties": {
             "id": {
               "type" : "long"
             },
             "text": {
               "type": "text" 
             }
          } 
        },
        "jobs" : {
        "_parent": {
            "type": "info" 
          },
          "properties": {
             "id": {
               "type" : "long"
             },
             "text": {
               "type": "text" 
             }
          } 
        }
    }
}

PUT /training_certificates/_mappings/industries
{
  "_parent": {
      "type": "info" 
    },
    "_routing": 
    {
      "required": true
    },
    "properties": {
        "industry_id: { "type": "text" },
        "industry": { "type": "text" }
    }
}

PUT /training_certificates/_mappings/specialties
{
  "_parent": {
      "type": "info" 
    },
    "_routing": 
    {
      "required": true
    },
    "properties": {
        "specialty_id": { "type": "text" },
        "specialty": { "type": "text" }
    }
}

PUT /training_certificates/_mappings/jobs
{
  "_parent": {
      "type": "info" 
    },
    "_routing": 
    {
      "required": true
    },
    "properties": {
        "job_id": { "type": "text" },
        "job": { "type": "text" }
    }
}

PUT /industries
{
    "mappings" : {
        "info" : {
            "properties" : {
                "industry_id" : { "type" : "text" },
                "en_industry" : { "type" : "text" },
                "date_created": { "type": "date", "format": "yyyy-MM-dd HH:mm:ss" },
                "date_updated": { "type": "date", "format": "yyyy-MM-dd HH:mm:ss" },
                "is_deleted": { "type": "integer" },
                "created_by_user_id": { "type": "text" },
                "approved_by_user_id": { "type": "text" },
                "is_approved": { "type": "integer" }
            }
        },
        "training_certificates" : {
        "_parent": {
            "type": "info"
          },
          "properties": {
             "id": {
               "type" : "long"
             },
             "text": {
               "type": "text" 
             }
          }
        },
        "specialties" : {
        "_parent": {
            "type": "info" 
          },
          "properties": {
             "id": {
               "type" : "long"
             },
             "text": {
               "type": "text" 
             }
          } 
        },
        "jobs" : {
        "_parent": {
            "type": "info" 
          },
          "properties": {
             "id": {
               "type" : "long"
             },
             "text": {
               "type": "text" 
             }
          } 
        }
    }
}

PUT /industries/_mappings/training_certificates
{
  "_parent": {
      "type": "info" 
    },
    "_routing": 
    {
      "required": true
    },
    "properties": {
        "training_certificate_id: { "type": "text" },
        "training_certificate": { "type": "text" }
    }
}

PUT /industries/_mappings/specialties
{
  "_parent": {
      "type": "info" 
    },
    "_routing": 
    {
      "required": true
    },
    "properties": {
        "specialty_id": { "type": "text" },
        "specialty": { "type": "text" }
    }
}

PUT /industries/_mappings/jobs
{
  "_parent": {
      "type": "info" 
    },
    "_routing": 
    {
      "required": true
    },
    "properties": {
        "job_id": { "type": "text" },
        "job": { "type": "text" }
    }
}

PUT /jobs
{
    "mappings" : {
        "info" : {
            "properties" : {
                "job_id" : { "type" : "text" },
                "en_job" : { "type" : "text" },
                "date_created": { "type": "date", "format": "yyyy-MM-dd HH:mm:ss" },
                "date_updated": { "type": "date", "format": "yyyy-MM-dd HH:mm:ss" },
                "is_deleted": { "type": "integer" },
                "created_by_user_id": { "type": "text" },
                "approved_by_user_id": { "type": "text" },
                "is_approved": { "type": "integer" }
            }
        },
        "training_certificates" : {
        "_parent": {
            "type": "info"
          },
          "properties": {
             "id": {
               "type" : "long"
             },
             "text": {
               "type": "text" 
             }
          }
        },
        "specialties" : {
        "_parent": {
            "type": "info" 
          },
          "properties": {
             "id": {
               "type" : "long"
             },
             "text": {
               "type": "text" 
             }
          } 
        },
        "industries" : {
        "_parent": {
            "type": "info" 
          },
          "properties": {
             "id": {
               "type" : "long"
             },
             "text": {
               "type": "text" 
             }
          } 
        },
        "skills" : {
        "_parent": {
            "type": "info" 
          },
          "properties": {
             "id": {
               "type" : "long"
             },
             "text": {
               "type": "text" 
             }
          } 
        }
    }
}


PUT /jobs/_mappings/training_certificates
{
  "_parent": {
      "type": "info" 
    },
    "_routing": 
    {
      "required": true
    },
    "properties": {
        "training_certificate_id: { "type": "text" },
        "training_certificate": { "type": "text" }
    }
}

PUT /jobs/_mappings/specialties
{
  "_parent": {
      "type": "info" 
    },
    "_routing": 
    {
      "required": true
    },
    "properties": {
        "specialty_id": { "type": "text" },
        "specialty": { "type": "text" }
    }
}

PUT /jobs/_mappings/industries
{
  "_parent": {
      "type": "info" 
    },
    "_routing": 
    {
      "required": true
    },
    "properties": {
        "industry_id": { "type": "text" },
        "industry": { "type": "text" }
    }
}

PUT /jobs/_mappings/skills
{
  "_parent": {
      "type": "info" 
    },
    "_routing": 
    {
      "required": true
    },
    "properties": {
        "skill_id": { "type": "text" },
        "skill": { "type": "text" }
    }
}

=======================================================================
= COUNTRIES ELASTIC SEARCH
=======================================================================

PUT /countries
{
    "mappings" : {
        "info" : {
            "properties" : {
                "country_id" : { "type" : "text" },
                "en_country" : { "type" : "text" },
                "date_created": { "type": "date", "format": "yyyy-MM-dd HH:mm:ss" },
                "date_updated": { "type": "date", "format": "yyyy-MM-dd HH:mm:ss" },
                "is_deleted": { "type": "integer" },
                "created_by_user_id": { "type": "text" },
                "approved_by_user_id": { "type": "text" },
                "is_approved": { "type": "integer" }
            }
        },
        "schools" : {
        "_parent": {
            "type": "info"
          },
          "properties": {
             "id": {
               "type" : "long"
             },
             "text": {
               "type": "text" 
             }
          }
        },
        "courses" : {
        "_parent": {
            "type": "info" 
          },
          "properties": {
             "id": {
               "type" : "long"
             },
             "text": {
               "type": "text" 
             }
          } 
        }
    }
}

PUT /countries/_mappings/schools
{
  "_parent": {
      "type": "info" 
    },
    "_routing": 
    {
      "required": true
    },
    "properties": {
        "school_id": { "type": "text" },
        "school": { "type": "text" }
    }
}

PUT /countries/_mappings/courses
{
  "_parent": {
      "type": "info" 
    },
    "_routing": 
    {
      "required": true
    },
    "properties": {
        "course_id": { "type": "text" },
        "course": { "type": "text" }
    }
}

PUT /schools
{
    "mappings" : {
        "info" : {
            "properties" : {
                "school_id" : { "type" : "text" },
                "en_schools" : { "type" : "text" },
                "date_created": { "type": "date", "format": "yyyy-MM-dd HH:mm:ss" },
                "date_updated": { "type": "date", "format": "yyyy-MM-dd HH:mm:ss" },
                "is_deleted": { "type": "integer" },
                "created_by_user_id": { "type": "text" },
                "approved_by_user_id": { "type": "text" },
                "is_approved": { "type": "integer" }
            }
        },
        "countries" : {
        "_parent": {
            "type": "info"
          },
          "properties": {
             "id": {
               "type" : "long"
             },
             "text": {
               "type": "text" 
             }
          }
        },
        "courses" : {
        "_parent": {
            "type": "info" 
          },
          "properties": {
             "id": {
               "type" : "long"
             },
             "text": {
               "type": "text" 
             }
          } 
        }
    }
}

PUT /schools/_mappings/countries
{
  "_parent": {
      "type": "info" 
    },
    "_routing": 
    {
      "required": true
    },
    "properties": {
        "country_id": { "type": "text" },
        "country": { "type": "text" }
    }
}

PUT /schools/_mappings/courses
{
  "_parent": {
      "type": "info" 
    },
    "_routing": 
    {
      "required": true
    },
    "properties": {
        "course_id": { "type": "text" },
        "course": { "type": "text" }
    }
}

PUT /courses
{
    "mappings" : {
        "info" : {
            "properties" : {
                "school_id" : { "type" : "text" },
                "en_schools" : { "type" : "text" },
                "date_created": { "type": "date", "format": "yyyy-MM-dd HH:mm:ss" },
                "date_updated": { "type": "date", "format": "yyyy-MM-dd HH:mm:ss" },
                "is_deleted": { "type": "integer" },
                "created_by_user_id": { "type": "text" },
                "approved_by_user_id": { "type": "text" },
                "is_approved": { "type": "integer" }
            }
        },
        "countries" : {
        "_parent": {
            "type": "info"
          },
          "properties": {
             "id": {
               "type" : "long"
             },
             "text": {
               "type": "text" 
             }
          }
        },
        "schools" : {
        "_parent": {
            "type": "info" 
          },
          "properties": {
             "id": {
               "type" : "long"
             },
             "text": {
               "type": "text" 
             }
          } 
        }
    }
}

PUT /courses/_mappings/countries
{
  "_parent": {
      "type": "info" 
    },
    "_routing": 
    {
      "required": true
    },
    "properties": {
        "country_id": { "type": "text" },
        "country": { "type": "text" }
    }
}

PUT /courses/_mappings/schools
{
  "_parent": {
      "type": "info" 
    },
    "_routing": 
    {
      "required": true
    },
    "properties": {
        "school_id": { "type": "text" },
        "school": { "type": "text" }
    }
}

=======================================================================
= COURSES ELASTIC SEARCH
=======================================================================

PUT /courses
{
    "mappings" : {
        "info" : {
            "properties" : {
                "course_id" : { "type" : "text" },
                "en_course" : { "type" : "text" },
                "date_created": { "type": "date", "format": "yyyy-MM-dd HH:mm:ss" },
                "date_updated": { "type": "date", "format": "yyyy-MM-dd HH:mm:ss" },
                "is_deleted": { "type": "integer" },
                "created_by_user_id": { "type": "text" },
                "approved_by_user_id": { "type": "text" },
                "is_approved": { "type": "integer" }
            }
        },
        "skills" : {
        "_parent": {
            "type": "info"
          },
          "properties": {
             "id": {
               "type" : "long"
             }
          }
        },
        "industry" : {
        "_parent": {
            "type": "info" 
          },
          "properties": {
             "id": {
               "type" : "long"
             }
          } 
        },
        "position" : {
        "_parent": {
            "type": "info"
          },
          "properties": {
             "id": {
               "type" : "long"
             }
          }
        },
        "interest" : {
        "_parent": {
            "type": "info"
          },
          "properties": {
             "id": {
               "type" : "long"
             }
          }
        },
        "specialties" : {
        "_parent": {
            "type": "info"
          },
          "properties": {
             "id": {
               "type" : "long"
             }
          }
        }
    }
}

PUT /courses/_mappings/skills
{
  "_parent": {
      "type": "info" 
    },
    "_routing": 
    {
      "required": true
    },
    "properties": {
        "skill_id": { "type": "text" }
    }
}

PUT /courses/_mappings/industry
{
  "_parent": {
      "type": "info" 
    },
    "_routing": 
    {
      "required": true
    },
    "properties": {
        "industry_id": { "type": "text" }
    }
}

PUT /courses/_mappings/position
{
  "_parent": {
      "type": "info" 
    },
    "_routing": 
    {
      "required": true
    },
    "properties": {
        "position_id": { "type": "text" }
    }
}

PUT /courses/_mappings/interest
{
  "_parent": {
      "type": "info" 
    },
    "_routing": 
    {
      "required": true
    },
    "properties": {
        "interest_id": { "type": "text" }
    }
}

PUT /courses/_mappings/specialties
{
  "_parent": {
      "type": "info" 
    },
    "_routing": 
    {
      "required": true
    },
    "properties": {
        "specialty_id": { "type": "text" }
    }
}


=======================================================================
= INTEREST ELASTIC SEARCH
=======================================================================

PUT /interest
{
    "mappings" : {
        "info" : {
            "properties" : {
                "interest_id" : { "type" : "text" },
                "en_interest" : { "type" : "text" },
                "date_created": { "type": "date", "format": "yyyy-MM-dd HH:mm:ss" },
                "date_updated": { "type": "date", "format": "yyyy-MM-dd HH:mm:ss" },
                "is_deleted": { "type": "integer" },
                "created_by_user_id": { "type": "text" },
                "approved_by_user_id": { "type": "text" },
                "is_approved": { "type": "integer" }
            }
        },
        "skills" : {
        "_parent": {
            "type": "info"
          },
          "properties": {
             "id": {
               "type" : "long"
             }
          }
        },
        "industry" : {
        "_parent": {
            "type": "info" 
          },
          "properties": {
             "id": {
               "type" : "long"
             }
          } 
        },
        "position" : {
        "_parent": {
            "type": "info"
          },
          "properties": {
             "id": {
               "type" : "long"
             }
          }
        },
        "courses" : {
        "_parent": {
            "type": "info"
          },
          "properties": {
             "id": {
               "type" : "long"
             }
          }
        },
        "specialties" : {
        "_parent": {
            "type": "info"
          },
          "properties": {
             "id": {
               "type" : "long"
             }
          }
        }
    }
}

PUT /interest/_mappings/skills
{
  "_parent": {
      "type": "info" 
    },
    "_routing": 
    {
      "required": true
    },
    "properties": {
        "skill_id": { "type": "text" }
    }
}

PUT /interest/_mappings/industry
{
  "_parent": {
      "type": "info" 
    },
    "_routing": 
    {
      "required": true
    },
    "properties": {
        "industry_id": { "type": "text" }
    }
}

PUT /interest/_mappings/position
{
  "_parent": {
      "type": "info" 
    },
    "_routing": 
    {
      "required": true
    },
    "properties": {
        "position_id": { "type": "text" }
    }
}

PUT /interest/_mappings/courses
{
  "_parent": {
      "type": "info" 
    },
    "_routing": 
    {
      "required": true
    },
    "properties": {
        "course_id": { "type": "text" }
    }
}

PUT /interest/_mappings/specialties
{
  "_parent": {
      "type": "info" 
    },
    "_routing": 
    {
      "required": true
    },
    "properties": {
        "specialty_id": { "type": "text" }
    }
}

=======================================================================
= SPECIALTIES ELASTIC SEARCH
=======================================================================

PUT /specialties
{
    "mappings" : {
        "info" : {
            "properties" : {
                "specialty_id" : { "type" : "text" },
                "en_specialty" : { "type" : "text" },
                "date_created": { "type": "date", "format": "yyyy-MM-dd HH:mm:ss" },
                "date_updated": { "type": "date", "format": "yyyy-MM-dd HH:mm:ss" },
                "is_deleted": { "type": "integer" },
                "created_by_user_id": { "type": "text" },
                "approved_by_user_id": { "type": "text" },
                "is_approved": { "type": "integer" }
            }
        },
        "skills" : {
        "_parent": {
            "type": "info"
          },
          "properties": {
             "id": {
               "type" : "long"
             }
          }
        },
        "industry" : {
        "_parent": {
            "type": "info" 
          },
          "properties": {
             "id": {
               "type" : "long"
             }
          } 
        },
        "position" : {
        "_parent": {
            "type": "info"
          },
          "properties": {
             "id": {
               "type" : "long"
             }
          }
        },
        "courses" : {
        "_parent": {
            "type": "info"
          },
          "properties": {
             "id": {
               "type" : "long"
             }
          }
        },
        "interest" : {
        "_parent": {
            "type": "info"
          },
          "properties": {
             "id": {
               "type" : "long"
             }
          }
        }
    }
}

PUT /specialties/_mappings/skills
{
  "_parent": {
      "type": "info" 
    },
    "_routing": 
    {
      "required": true
    },
    "properties": {
        "skill_id": { "type": "text" }
    }
}

PUT /specialties/_mappings/industry
{
  "_parent": {
      "type": "info" 
    },
    "_routing": 
    {
      "required": true
    },
    "properties": {
        "industry_id": { "type": "text" }
    }
}

PUT /specialties/_mappings/position
{
  "_parent": {
      "type": "info" 
    },
    "_routing": 
    {
      "required": true
    },
    "properties": {
        "position_id": { "type": "text" }
    }
}

PUT /specialties/_mappings/courses
{
  "_parent": {
      "type": "info" 
    },
    "_routing": 
    {
      "required": true
    },
    "properties": {
        "course_id": { "type": "text" }
    }
}

PUT /specialties/_mappings/interest
{
  "_parent": {
      "type": "info" 
    },
    "_routing": 
    {
      "required": true
    },
    "properties": {
        "interest_id": { "type": "text" }
    }
}