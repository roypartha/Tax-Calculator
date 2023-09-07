package com.repository;

import com.domain.Tax;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.SessionFactory;
import org.springframework.stereotype.Repository;

import java.util.List;

@Repository
public class TaxRepositoryImpl implements TaxRepository{
    private SessionFactory sessionFactory;

    public TaxRepositoryImpl(SessionFactory sessionFactory) {
        this.sessionFactory = sessionFactory;
    }

    public List<Tax> list() {
        Session session = sessionFactory.getCurrentSession();
        Query<Tax> taxQuery = session.createQuery("from Tax", Tax.class);
        return taxQuery.getResultList();
    }
    public Tax get(Long id) {
        Session session = sessionFactory.getCurrentSession();
        return session.get(Tax.class, id);
    }
    public  List<Tax> getAllByUsername(String username){
        Session session = sessionFactory.getCurrentSession();
        Query<Tax> taxQuery = session.createQuery("from Tax where username = :username", Tax.class);
        taxQuery.setParameter("username", username);
        return taxQuery.getResultList();
    }
    public Tax create(Tax tax) {
        Session session = sessionFactory.getCurrentSession();
        session.save(tax);
        return tax;
    }
    public Tax update(Tax tax) {
        Session session = sessionFactory.getCurrentSession();
        session.saveOrUpdate(tax);
        return tax;
    }
    public boolean delete(Long id) {
        Session session = sessionFactory.getCurrentSession();
        Tax tax = get(id);
        if (tax != null) {
            session.delete(tax);
            return true;
        }
        else return false;
    }
}