package com.controller;

import com.domain.Tax;
import com.service.TaxService;
import org.springframework.beans.propertyeditors.StringTrimmerEditor;
import org.springframework.web.bind.WebDataBinder;
import org.springframework.web.bind.annotation.*;

import javax.validation.Valid;
import java.security.Principal;
import java.util.List;

@RestController
@CrossOrigin()
@RequestMapping("/tax")
public class TaxController {
    private TaxService taxService;

    public TaxController(TaxService taxService) {
        this.taxService = taxService;
    }

    @InitBinder
    public void initBinder(WebDataBinder webDataBinder) {
        StringTrimmerEditor stringTrimmerEditor = new StringTrimmerEditor(true);
        webDataBinder.registerCustomEditor(String.class, stringTrimmerEditor);
    }

//    @RequestMapping("/calculator")
//    public String createForm(Model model) {
//        Tax tax = new Tax();
//        model.addAttribute("taxableIncome", tax);
//        return "calculator";
//    }

    @PostMapping("/calculate")
    public Tax calculate(@Valid @RequestBody Tax tax,Principal principal) {
        tax.setUsername(principal.getName());
        return taxService.calculateTax(tax);
    }

    @GetMapping("/history")
    public List<Tax> history(Principal principal){
        return taxService.getAllByUsername(principal.getName());
    }
//    @GetMapping("/test")
//    public Tax test(){
//
//      return taxService.get(8L);
//    }
}