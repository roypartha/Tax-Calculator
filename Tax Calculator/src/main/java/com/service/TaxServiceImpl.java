package com.service;

import com.domain.Tax;
import com.repository.TaxRepositoryImpl;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import java.util.List;


@Service
@Transactional
public class TaxServiceImpl implements TaxService {
    private TaxRepositoryImpl taxRepositoryImpl;

    public TaxServiceImpl(TaxRepositoryImpl taxRepositoryImpl) {
        this.taxRepositoryImpl = taxRepositoryImpl;
    }

    @Transactional
    public Tax insert(Tax tax) {
        return taxRepositoryImpl.create(tax);
    }

    @Transactional(readOnly = true)
    public List<Tax> getAllByUsername(String username) {
        return taxRepositoryImpl.getAllByUsername(username);
    }
//    @Transactional(readOnly = true)
//    public List<Tax> getAll(Long id) {
//        return taxRepository.getAllByUserid(id);
//    }

    @Transactional
    public Tax calculateTax(Tax tax) {
        double basic_salary = tax.getBasic_salary();
        double exemption_basic_salary = 0;
        double taxable_basic_salary = (Long) Math.round(basic_salary);
        tax.setBasic_salary_exemption(exemption_basic_salary);
        tax.setBasic_salary_taxable(taxable_basic_salary);

        double exemption_houseRent = Math.min(basic_salary * 0.5, 12 * 25000);
        double taxable_houseRent = tax.getHouserent() - exemption_houseRent < 0 ? 0 : tax.getHouserent() - exemption_houseRent;
        tax.setHouserent_exemption(exemption_houseRent);
        tax.setHouserent_taxable(taxable_houseRent);

        double exemption_medical = Math.round(Math.min(basic_salary * 0.1, 120000));
        double taxable_medical = tax.getMedical() - exemption_medical < 0 ? 0 : tax.getMedical() - exemption_medical;
        tax.setMedical_exemption(exemption_medical);
        tax.setMedical_taxable(taxable_medical);

        double exemption_conveyance = 30000;
        double taxable_conveyance = tax.getConveyance() - exemption_conveyance < 0 ? 0 : tax.getConveyance() - exemption_conveyance;
        tax.setConveyance_exemption(exemption_conveyance);
        tax.setConveyance_taxable(taxable_conveyance);

        double taxable_commission = tax.getCommission();
        tax.setCommission_exemption(0);
        tax.setCommission_taxable(taxable_commission);

        double taxable_bonus = tax.getBonus();
        tax.setBonus_exemption(0);
        tax.setBonus_taxable(taxable_bonus);

        double totalIncome = basic_salary + tax.getMedical() + tax.getMedical()
                + tax.getConveyance() + tax.getCommission() + tax.getBonus();
        double totalTaxable = taxable_basic_salary + taxable_houseRent + taxable_medical + taxable_conveyance
                + taxable_commission + taxable_bonus;
        tax.setTotalIncome(totalIncome);
        tax.setTotalTaxable(totalTaxable);

        String category = tax.getCategory();
        Double taxBase = (category == "General" ? 300000.0 : category == "Female/Senior Citizen" ? 350000.0 :
                category == "Disabled" ? 450000.0 : 475000.0);
        Double grossTax = 0.0;
        if (totalTaxable > taxBase) {
            totalTaxable -= taxBase;
            grossTax += Math.round((totalTaxable > 100000 ? 100000 : totalTaxable) * 0.5);
            totalTaxable -= 100000;
            grossTax += Math.round((totalTaxable > 300000 ? 300000 : totalTaxable > 0 ? totalTaxable : 0) * 0.1);
            totalTaxable -= 300000;
            grossTax += Math.round((totalTaxable > 400000 ? 400000 : totalTaxable > 0 ? totalTaxable : 0) * 0.15);
            totalTaxable -= 400000;
            grossTax += Math.round((totalTaxable > 500000 ? 500000 : totalTaxable > 0 ? totalTaxable : 0) * 0.2);
            totalTaxable -= 500000;
            grossTax += Math.round((totalTaxable > 0 ? totalTaxable : 0) * 0.25);
        }
        tax.setGrossTax(grossTax);
        insert(tax);
        return tax;
    }
}
